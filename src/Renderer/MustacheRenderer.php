<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Renderer;

/**
 * The MustacheRenderer class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class MustacheRenderer extends AbstractAdapterRenderer
{
	/**
	 * Property engine.
	 *
	 * @var \Mustache_Engine
	 */
	protected $engine;

	/**
	 * Property loader.
	 *
	 * @var \Mustache_Loader
	 */
	protected $loader;

	/**
	 * render
	 *
	 * @param string $file
	 * @param array  $data
	 *
	 * @return  string
	 */
	public function render($file, $data = array())
	{
		$engine = $this->getEngine();

		$path = $this->findFile($file);

		$engine->setLoader($this->getLoader(dirname($path)));

		return $engine->render($file, $data);
	}

	/**
	 * findFile
	 *
	 * @param string $file
	 * @param string $ext
	 *
	 * @return  string
	 */
	public function findFile($file, $ext = '')
	{
		$ext = $ext ? : $this->config->get('extension', 'mustache');

		return parent::findFile($file, $ext);
	}

	/**
	 * Method to get property Engine
	 *
	 * @param   boolean $new
	 *
	 * @return  \Mustache_Engine
	 */
	public function getEngine($new = false)
	{
		if (!$this->engine)
		{
			$this->engine = new \Mustache_Engine($this->config->get('options', array()));
		}

		return $this->engine;
	}

	/**
	 * Method to set property engine
	 *
	 * @param   \Mustache_Engine $engine
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setEngine($engine)
	{
		$this->engine = $engine;

		return $this;
	}

	/**
	 * Method to get property Loader
	 *
	 * @param string $path
	 *
	 * @return  \Mustache_Loader
	 */
	public function getLoader($path = null)
	{
		if (!$this->loader)
		{
			$options = array(
				// 'extension' => '.html'
			);

			$options = array_merge($options, (array) $this->config->get('loader_options', array()));

			$this->loader = new \Mustache_Loader_FilesystemLoader($path, $options);
		}

		return $this->loader;
	}

	/**
	 * Method to set property loader
	 *
	 * @param   \Mustache_Loader $loader
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setLoader($loader)
	{
		$this->loader = $loader;

		return $this;
	}
}
