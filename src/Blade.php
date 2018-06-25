<?php

namespace PedroBorges\Blade;

use Jenssegers\Blade\Blade as BladeEngine;
use Illuminate\View\Compilers\BladeCompiler;

class Blade
{
    protected $engine;
    protected $compiler;

    /**
     * Creates a new view object
     *
     * @param string $file
     * @param array  $data
     */
    public function __construct($viewPath)
    {
        $this->engine = new BladeEngine(
            $viewPath,
            kirby()->roots()->cache()
        );

        $this->compiler = $this->engine->compiler();
        $this->compiler->setEchoFormat('html(%s)');
    }

    /**
     * Retrieves Blade object
     */
    public function engine(): BladeEngine
    {
        return $this->engine;
    }

    /**
     * Retrieves BladeCompiler object
     */
    public function compiler(): BladeCompiler
    {
        return $this->compiler;
    }

    /**
     * Renders Blade views
     *
     * @param string $file
     * @param array  $data
     */
    public function render(string $view, array $data = []): string
    {
        return $this->engine()->render($view, $data);
    }
}
