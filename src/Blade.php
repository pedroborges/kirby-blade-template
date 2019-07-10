<?php

namespace PedroBorges\Blade;

use Jenssegers\Blade\Blade as BaseBlade;
use PedroBorges\Blade\View\ViewServiceProvider;
use Illuminate\Container\Container;

class Blade extends BaseBlade
{
    /**
     * Constructor.
     *
     * @param string|array       $viewPaths
     * @param string             $cachePath
     * @param ContainerInterface $container
     */
    public function __construct($viewPaths, $cachePath, ContainerInterface $container = null)
    {
        $this->viewPaths = $viewPaths;
        $this->cachePath = $cachePath;
        $this->container = $container ?: new Container;
        $this->setupContainer();

        (new ViewServiceProvider($this->container))->register();
        $this->engineResolver = $this->container->make('view.engine.resolver');
    }
}
