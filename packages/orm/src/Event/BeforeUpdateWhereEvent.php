<?php

/**
 * Part of Windwalker Packages project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace Windwalker\ORM\Event;

use Attribute;

/**
 * The BeforeUpdateBatchEvent class.
 */
#[Attribute]
class BeforeUpdateWhereEvent extends AbstractUpdateWhereEvent
{
}
