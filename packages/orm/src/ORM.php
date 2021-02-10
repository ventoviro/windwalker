<?php

/**
 * Part of Windwalker Packages project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace Windwalker\ORM;

use Windwalker\Attributes\AttributesAwareTrait;
use Windwalker\Attributes\AttributesResolver;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\ORM\Attributes\PK;
use Windwalker\ORM\Attributes\Table;
use Windwalker\ORM\Metadata\EntityMetadata;
use Windwalker\ORM\Metadata\EntityMetadataCollection;
use Windwalker\ORM\Strategy\Selector;
use Windwalker\ORM\Test\Entity\User;

/**
 * The ORM class.
 */
class ORM
{
    use AttributesAwareTrait;

    protected DatabaseAdapter $db;

    protected EntityMetadataCollection $entityMetadataCollection;

    /**
     * ORM constructor.
     *
     * @param  DatabaseAdapter  $db
     */
    public function __construct(DatabaseAdapter $db)
    {
        $this->db = $db;

        $this->entityMetadataCollection = new EntityMetadataCollection();
    }

    public function from(mixed $tables, ?string $alias = null): Selector
    {
        return (new Selector($this->getDb()))->from($tables, $alias);
    }

    public function select(...$columns): Selector
    {
        return (new Selector($this->getDb()))->select(...$columns);
    }

    public function findOne(string|object $entity, mixed $conditions): ?object
    {
        if (is_string($entity)) {
            $entity = $this->getAttributesResolver()->createObject($entity);
        }

        $metadata = $this->entityMetadataCollection->get($entity);

        $stmt = $this->from($metadata->getTableName())
            ->select('*')
            ->where(static::conditionsToWheres($metadata, $conditions))
            ->execute();

        return $stmt->get($metadata->getClassName());
    }

    public static function conditionsToWheres(EntityMetadata $metadata, mixed $conditions): array
    {
        if (!is_array($conditions)) {
            $key = $metadata->getMainKey();

            if ($key) {
                $conditions = [$key => $conditions];
            } else {
                throw new \LogicException(
                    sprintf(
                        'Conditions cannot be scalars since %s has no keys',
                        $metadata->getClassName()
                    )
                );
            }
        }

        return $conditions;
    }

    /**
     * @return DatabaseAdapter
     */
    public function getDb(): DatabaseAdapter
    {
        return $this->db;
    }

    /**
     * @param  DatabaseAdapter  $db
     *
     * @return  static  Return self to support chaining.
     */
    public function setDb(DatabaseAdapter $db): static
    {
        $this->db = $db;

        return $this;
    }
}
