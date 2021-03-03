<?php

/**
 * Part of Windwalker Packages project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace Windwalker\ORM\Nested;

/**
 * The Position class.
 */
class Position
{
    public const AFTER = 2;

    public const LAST_CHILD = 6;

    public const FIRST_CHILD = 4;

    public const BEFORE = 1;

    /**
     * Position constructor.
     *
     * @param  mixed  $referenceId
     * @param  int    $position
     */
    public function __construct(
        protected mixed $referenceId = null,
        protected int $position = self::AFTER
    ) {
        //
    }

    /**
     * @return mixed
     */
    public function getReferenceId(): mixed
    {
        return $this->referenceId;
    }

    /**
     * @param  mixed  $referenceId
     *
     * @return  static  Return self to support chaining.
     */
    public function setReferenceId(mixed $referenceId): static
    {
        $this->referenceId = $referenceId;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param  int  $position
     *
     * @return  static  Return self to support chaining.
     */
    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }
}
