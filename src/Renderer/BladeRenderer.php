<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Renderer;

use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Environment as BladeEnvironment;

/**
 * The BladeRenderer class.
 *
 * @since  {DEPLOY_VERSION}
 */
class BladeRenderer extends AbstractAdapterRenderer
{
	/**
	 * Property blade.
	 *
	 * @var  BladeEnvironment
	 */
	protected $engine = null;

	/**
	 * Property filesystem.
	 *
	 * @var Filesystem
	 */
	protected $filesystem;

	/**
	 * Property finder.
	 *
	 * @var FileViewFinder
	 */
	protected $finder;

	/**
	 * Property resolver.
	 *
	 * @var EngineResolver
	 */
	protected $resolver;

	/**
	 * Property dispatcher.
	 *
	 * @var Dispatcher
	 */
	protected $dispatcher;

	/**
	 * Property compiler.
	 *
	 * @var CompilerEngine
	 */
	protected $compiler;

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
		return $this->getEngine()->make($file);
	}

	/**
	 * Method to get property Blade
	 *
	 * @param bool $new
	 *
	 * @return  BladeEnvironment
	 */
	public function getEngine($new = false)
	{
		if (!$this->engine || $new)
		{
			$this->engine = new BladeEnvironment($this->getResolver(), $this->getFinder(), $this->getDispatcher());
		}

		return $this->engine;
	}

	/**
	 * Method to set property blade
	 *
	 * @param   BladeEnvironment $blade
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setEngine($blade)
	{
		if (!($blade instanceof BladeEnvironment))
		{
			throw new \InvalidArgumentException('Engine object should be Illuminate\View\Environment.');
		}

		$this->engine = $blade;

		return $this;
	}

	/**
	 * Method to get property Filesystem
	 *
	 * @return  Filesystem
	 */
	public function getFilesystem()
	{
		if (!$this->filesystem)
		{
			$this->filesystem = new Filesystem;
		}

		return $this->filesystem;
	}

	/**
	 * Method to set property filesystem
	 *
	 * @param   Filesystem $filesystem
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setFilesystem($filesystem)
	{
		$this->filesystem = $filesystem;

		return $this;
	}

	/**
	 * Method to get property Finder
	 *
	 * @return  FileViewFinder
	 */
	public function getFinder()
	{
		if (!$this->finder)
		{
			$this->finder = new FileViewFinder($this->getFilesystem(), iterator_to_array(clone $this->getPaths()));
		}

		return $this->finder;
	}

	/**
	 * Method to set property finder
	 *
	 * @param   FileViewFinder $finder
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setFinder($finder)
	{
		$this->finder = $finder;

		return $this;
	}

	/**
	 * Method to get property Resolver
	 *
	 * @return  EngineResolver
	 */
	public function getResolver()
	{
		if (!$this->resolver)
		{
			$self = $this;

			$this->resolver = new EngineResolver;

			$this->resolver->register(
				'blade',
				function() use ($self)
				{
					return $self->getCompiler();
				}
			);
		}

		return $this->resolver;
	}

	/**
	 * Method to set property resolver
	 *
	 * @param   EngineResolver $resolver
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setResolver($resolver)
	{
		$this->resolver = $resolver;

		return $this;
	}

	/**
	 * Method to get property Dispatcher
	 *
	 * @return  Dispatcher
	 */
	public function getDispatcher()
	{
		if (!$this->dispatcher)
		{
			$this->dispatcher = new Dispatcher;
		}

		return $this->dispatcher;
	}

	/**
	 * Method to set property dispatcher
	 *
	 * @param   Dispatcher $dispatcher
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setDispatcher($dispatcher)
	{
		$this->dispatcher = $dispatcher;

		return $this;
	}

	/**
	 * Method to get property Compiler
	 *
	 * @return  CompilerEngine
	 */
	public function getCompiler()
	{
		if (!$this->compiler)
		{
			$cachePath = $this->config->get('cache_path');

			if (!$cachePath)
			{
				throw new \InvalidArgumentException('Please set cache_path into config.');
			}

			$this->compiler = new CompilerEngine(new BladeCompiler($this->getFilesystem(), $cachePath));
		}

		return $this->compiler;
	}

	/**
	 * Method to set property compiler
	 *
	 * @param   CompilerEngine $compiler
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setCompiler($compiler)
	{
		$this->compiler = $compiler;

		return $this;
	}
}
