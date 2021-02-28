<?php

/**
 * Part of Windwalker Packages project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace Windwalker\ORM\Strategy;

use Windwalker\Data\Collection;
use Windwalker\Database\Driver\StatementInterface;
use Windwalker\Database\Event\HydrateEvent;
use Windwalker\Database\Event\ItemFetchedEvent;
use Windwalker\ORM\Hydrator\EntityHydrator;
use Windwalker\ORM\Metadata\EntityMetadata;
use Windwalker\ORM\Relation\Strategy\ManyToMany;
use Windwalker\Query\Clause\AsClause;
use Windwalker\Query\Clause\JoinClause;
use Windwalker\Query\Query;
use Windwalker\Utilities\Arr;
use Windwalker\Utilities\Assert\ArgumentsAssert;

/**
 * The SelectAction class.
 *
 * Query methods.
 */
class Selector extends AbstractQueryStrategy
{
    protected ?string $groupDivider = null;

    public function autoSelections(string $divider = '.'): static
    {
        /** @var array<int, AsClause> $tables */
        $tables = array_values(Arr::collapse($this->getAllTables()));

        $db = $this->getDb();

        foreach ($tables as $i => $clause) {
            $tbm = $db->getTable(
                Query::convertClassToTable($clause->getValue(), $alias)
            );

            $cols = $tbm->getColumnNames();

            foreach ($cols as $col) {
                $alias = $clause->getAlias() ?? $alias;

                if ($i === 0) {
                    $as = $col;
                } else {
                    $as = $alias . $divider . $col;
                }

                $this->selectRaw(
                    '%n AS %r',
                    $alias . '.' . $col,
                    $this->quoteName($as, true)
                );
            }
        }

        return $this;
    }

    public function groupByDivider(string $divider = '.'): static
    {
        $this->groupDivider = $divider;

        return $this;
    }

    public function groupByJoins(string $divider = '.'): static
    {
        return $this->autoSelections($divider)
            ->groupByDivider($divider);
    }

    protected function groupItem(?array $item): ?array
    {
        if ($item === null) {
            return null;
        }

        foreach ($item as $k => $value) {
            if (str_contains($k, $this->groupDivider)) {
                [$prefix, $key] = explode($this->groupDivider, $k, 2);

                $item[$prefix] ??= new Collection();

                $item[$prefix][$key] = $value;

                unset($item[$k]);
            }
        }

        return $item;
    }

    public function join(string $type, mixed $table, ?string $alias = null, ...$on): static
    {
        if (!$on && class_exists($table)) {
            $on = $this->handleAutoJoin($type, $table, $alias, $on);
        }

        return parent::join($type, $table, $alias, ...$on);
    }

    private function handleAutoJoin(string $type, string $table, ?string &$alias, array $on): array
    {
        /** @var AsClause|null $fromClause */
        $fromClause = $this->getFrom()?->getElements()[0] ?? null;
        $from = $fromClause?->getValue();

        if (!$from) {
            return $on;
        }

        $fromMetadata = $this->getORM()->getEntityMetadata($from);
        $joinMetadata = $this->getORM()->getEntityMetadata($table);
        $relation = null;

        $fromAlias = $fromMetadata->getTableAlias();
        $alias ??= $joinMetadata->getTableAlias();

        foreach ($fromMetadata->getRelationManager()->getRelations() as $relation) {
            if ($relation instanceof ManyToMany) {
                if ($relation->getMapTable() === $table) {
                    foreach ($relation->getMapForeignKeys() as $ok => $mfk) {
                        $on[] = "$fromAlias.$ok";
                        $on[] = '=';
                        $on[] = "$alias.$mfk";
                    }
                    return $on;
                }

                if ($relation->getTargetTable() === $table) {
                    $mapMetadata = $relation->getMapMetadata();
                    $mapAlias = $mapMetadata->getTableAlias();

                    foreach ($relation->getForeignKeys() as $mk => $fk) {
                        $on[] = "$mapAlias.$mk";
                        $on[] = '=';
                        $on[] = "$alias.$fk";
                    }

                    return $on;
                }
            }

            if ($relation->getTargetTable() === $table) {
                foreach ($relation->getForeignKeys() as $ok => $fk) {
                    $on[] = "$fromAlias.$ok";
                    $on[] = '=';
                    $on[] = "$alias.$fk";
                }
                foreach ($relation->getMorphs() as $field => $value) {
                    $on[] = "$fromAlias.$field";
                    $on[] = '=';
                    $on[] = $value;
                }
                return $on;
            }
        }

        return $on;
    }

    protected function registerEvents(StatementInterface $stmt): StatementInterface
    {
        if ($this->groupDivider !== null) {
            $stmt->on(
                ItemFetchedEvent::class,
                function (ItemFetchedEvent $event) {
                    $item = $this->groupItem($event->getItem());
                    $event->setItem($item);
                }
            );
        }

        $stmt->on(
            HydrateEvent::class,
            function (HydrateEvent $event) {
                $orm  = $this->getORM();
                $item = $event->getItem();

                if ($item === null) {
                    return;
                }

                $object = $event->getClass();

                if (is_string($object)) {
                    $object = $orm->getAttributesResolver()->createObject($object);
                }

                $object = $orm->hydrateEntity($item, $object);

                if (EntityMetadata::isEntity($object)) {
                    // Prepare relations
                    $orm->getEntityMetadata($object)
                        ->getRelationManager()
                        ->load($item, $object);
                }

                $event->setItem($object);
            }
        );

        return $stmt;
    }

    public function prepareStatement(): StatementInterface
    {
        return $this->registerEvents(parent::prepareStatement());
    }
}
