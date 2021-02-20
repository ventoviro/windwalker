<?php

/**
 * Part of Windwalker Packages project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace Windwalker\ORM\Relation;

use Windwalker\Data\Collection;
use Windwalker\ORM\Strategy\Selector;
use Windwalker\Utilities\TypeCast;

/**
 * The RelationCollections class.
 */
class RelationCollection implements \IteratorAggregate, \JsonSerializable
{
    /**
     * @var object[]
     */
    protected array $attachedEntities = [];

    /**
     * @var object[]
     */
    protected array $detachedEntities = [];

    /**
     * @var object[]
     */
    protected ?array $cache = null;

    protected bool $sync = false;

    /**
     * RelationCollection constructor.
     *
     * @param  string         $className
     * @param  Selector|null  $query
     */
    public function __construct(
        protected string $className,
        protected ?Selector $query = null
    ) {
        //
    }

    public function attach(object|array $entities): static
    {
        if (is_object($entities)) {
            $entities = [$entities];
        }

        foreach ($entities as $entity) {
            $this->attachedEntities[spl_object_hash($entity)] = $entity;
        }

        return $this;
    }

    public function cancelAttach(object $entity): static
    {
        unset($this->attachedEntities[spl_object_hash($entity)]);

        return $this;
    }

    public function detach(object $entity): static
    {
        $this->detachedEntities[spl_object_hash($entity)] = $entity;

        return $this;
    }

    public function cancelDetach(object $entity): static
    {
        unset($this->detachedEntities[spl_object_hash($entity)]);

        return $this;
    }

    public function clearAttachesAndDetaches(): static
    {
        $this->attachedEntities = [];
        $this->detachedEntities = [];

        return $this;
    }

    public function clearCache(): static
    {
        $this->cache = null;
        $this->sync = false;

        return $this;
    }

    public function clearAll(): static
    {
        return $this->clearAttachesAndDetaches()->clearCache();
    }

    /**
     * all
     *
     * @param  string|null  $class
     *
     * @return Collection
     */
    public function all(?string $class = null): Collection
    {
        return \Windwalker\collect(iterator_to_array($this->getIterator($class)));
    }

    /**
     * @inheritDoc
     */
    public function getIterator(?string $class = null): \Generator
    {
        if ($this->query === null) {
            return;
        }

        $iterator = $this->cache ?? $this->query->getIterator($class ?? $this->className);

        $cache = [];

        foreach ($iterator as $k => $item) {
            $cache[$k] = $item;

            yield $k => $item;
        }

        $this->cache = $cache;
    }

    /**
     * @return Selector|null
     */
    public function getQuery(): ?Selector
    {
        return $this->query;
    }

    /**
     * @return object[]
     */
    public function getAttachedEntities(): array
    {
        return $this->attachedEntities;
    }

    /**
     * @param  object[]  $attachedEntities
     *
     * @return  static  Return self to support chaining.
     */
    public function setAttachedEntities(array $attachedEntities): static
    {
        $this->attachedEntities = $attachedEntities;

        return $this;
    }

    /**
     * @return object[]
     */
    public function getDetachedEntities(): array
    {
        return $this->detachedEntities;
    }

    /**
     * @param  object[]  $detachedEntities
     *
     * @return  static  Return self to support chaining.
     */
    public function setDetachedEntities(array $detachedEntities): static
    {
        $this->detachedEntities = $detachedEntities;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->cache ?? [];
    }

    /**
     * @return bool
     */
    public function isSync(): bool
    {
        return $this->sync;
    }

    /**
     * @param  array $items
     *
     * @return  static  Return self to support chaining.
     */
    public function sync(iterable $items): static
    {
        $this->sync = true;

        $this->cache = TypeCast::toArray($items);

        return $this;
    }
}