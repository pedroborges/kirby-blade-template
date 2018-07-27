<?php

namespace PedroBorges\Blade;

use Exception;
use Illuminate\View\Compilers\BladeCompiler;
use Jenssegers\Blade\Blade as BladeEngine;
use Kirby\Toolkit\Dir;

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
        $cachePath = kirby()->roots()->cache() . '/blade';

        try {
            Dir::make($cachePath);
        } catch (Exception $e) {
            throw new Exception("Cache directory [{$cache}] does not exist or is not writable.");
        }

        $this->engine = new BladeEngine(
            $viewPath,
            $cachePath
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
