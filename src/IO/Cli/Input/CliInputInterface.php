<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\IO\Cli\Input;

/**
 * Interface CliInputInterface
 */
interface CliInputInterface
{
	/**
	 * Get a value from standard input.
	 *
	 * @return  string  The input string from standard input.
	 */
	public function in();

	/**
	 * Gets a value from the input data.
	 *
	 * @param   string $name    Name of the value to get.
	 * @param   mixed  $default Default value to return if variable does not exist.
	 *
	 * @return  mixed  The filtered input value.
	 *
	 * @since   1.0
	 */
	public function get($name, $default = null);

	/**
	 * Sets a value
	 *
	 * @param   string $name  Name of the value to set.
	 * @param   mixed  $value Value to assign to the input.
	 *
	 * @return  CliInputInterface
	 *
	 * @since   1.0
	 */
	public function set($name, $value);

	/**
	 * getArgument
	 *
	 * @param integer $offset
	 * @param mixed   $default
	 *
	 * @return  mixed
	 */
	public function getArgument($offset, $default = null);

	/**
	 * getCalledScript
	 *
	 * @return  string
	 */
	public function getCalledScript();
}
 