<?php

namespace PedroBorges\Blade;

use Jenssegers\Blade\Blade as BaseBlade;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\Container as ContainerInterface;
use Illuminate\Contracts\View\View;
use PedroBorges\Blade\View\ViewServiceProvider;

class Blade extends BaseBlade
{
    /**
     * Constructor.
     *
     * @param string|array       $viewPaths
     * @param string             $cachePath
     * @param ContainerInterface $container
     */
    public function __construct($viewPaths, string $cachePath, ContainerInterface $container = null)
    {
        $this->container = $container ?: new Container;

        $this->setupContainer((array) $viewPaths, $cachePath);
        (new ViewServiceProvider($this->container))->register();

        $this->factory = $this->container->get('view');
        $this->compiler = $this->container->get('blade.compiler');
    }

    public function make($view, $data = [], $mergeData = []): View
    {
        return $this->factory->make($view, $data, $mergeData);
    }
}
