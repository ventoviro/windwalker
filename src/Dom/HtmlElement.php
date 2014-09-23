<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2008 - 2014 Asikart.com. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Dom;

use Windwalker\Dom\Builder\HtmlBuilder;

/**
 * The Html element object.
 *
 * @since {DEPLOY_VERSION}
 */
class HtmlElement extends DomElement
{
	/**
	 * toString
	 *
	 * @param boolean $forcePair
	 *
	 * @return  string
	 */
	public function toString($forcePair = false)
	{
		return HtmlBuilder::create($this->name, $this->content, $this->attribs, $forcePair);
	}
}

