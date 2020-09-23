<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2019 LYRASOFT.
 * @license    MIT
 */

declare(strict_types=1);

namespace Windwalker\Attributes\Test\Stub\Attrs;

use Windwalker\Attributes\AttributeHandler;
use Windwalker\Attributes\AttributeInterface;

/**
 * The PropWrap class.
 */
#[\Attribute]
class PropWrap implements AttributeInterface
{
    public $instance;

    public string $wrap;

    /**
     * PropWrap constructor.
     *
     * @param $wrap
     */
    public function __construct(string $wrap)
    {
        $this->wrap = $wrap;
    }

    public function __invoke(AttributeHandler $handler)
    {
        return function (...$args) use ($handler) {
            $this->instance = $handler(...$args);

            return new ($this->wrap)($this->instance);
        };
    }
}
