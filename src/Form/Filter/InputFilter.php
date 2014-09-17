<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2008 - 2014 Asikart.com. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Form\Filter;

use Windwalker\Filter\InputFilter as WindwalkerFilter;

/**
 * The InputFiler class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class InputFilter implements FilterInterface
{
	/**
	 * Property filter.
	 *
	 * @var  WindwalkerFilter
	 */
	protected static $filter = null;

	/**
	 * Property type.
	 *
	 * @var  string
	 */
	protected $type = null;

	/**
	 * Constructor.
	 *
	 * @param string $type
	 */
	public function __construct($type = null)
	{
		$this->type = $type;

		static::$filter = static::getFilter();
	}

	/**
	 * clean
	 *
	 * @param string $text
	 *
	 * @return  mixed
	 */
	public function clean($text)
	{
		if (!$this->type)
		{
			return $text;
		}

		return static::$filter->clean($text, $this->type);
	}

	/**
	 * getFilter
	 *
	 * @return  WindwalkerFilter
	 */
	protected static function getFilter()
	{
		if (!static::$filter)
		{
			static::$filter = new WindwalkerFilter;
		}

		return static::$filter;
	}

	/**
	 * Method to set property filter
	 *
	 * @param   \Windwalker\Filter\WindwalkerFilter $filter
	 *
	 * @return  void
	 */
	public static function setFilter(WindwalkerFilter $filter)
	{
		self::$filter = $filter;
	}

	/**
	 * Method to get property Type
	 *
	 * @return  string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Method to set property type
	 *
	 * @param   string $type
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setType($type)
	{
		$this->type = $type;

		return $this;
	}
}