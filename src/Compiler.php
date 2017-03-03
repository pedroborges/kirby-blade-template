<?php

namespace PedroBorges\Blade;

use Jenssegers\Blade\Blade;
use Kirby;

class Compiler
{
    protected static $instance = null;

    protected $blade;

    public function __construct()
    {
        $this->kirby = Kirby::instance();

        $templates = $this->kirby->roots()->templates();
        $cache = $this->kirby->roots()->cache();

        $this->blade = new Blade(
            $this->kirby->get('option', 'blade.views', $templates),
            $this->kirby->get('option', 'blade.cache', $cache)
        );

        $this->blade->compiler()->setEchoFormat('html(%s)');

        static::$instance = $this;
    }

     /**
     * Creates a new compiler instance.
     *
     * @param  string  $root
     * @return Compiler
     */
    public static function instance()
    {
        return static::$instance = is_null(static::$instance)
            ? new static
            : static::$instance;
    }

     /**
     * Renders Blade views
     *
     * @param  string  $template
     * @param  array   $data
     *
     * @return string
     */
    public static function render($view, $data)
    {
        return self::instance()->blade->make($view, $data);
    }


    /**
     * Pass any method to the compiler instance.
     *
     * @param   string $method
     * @param   array  $params
     * @return  mixed
     */
    public function __call($method, $params)
    {
        return call_user_func_array([$this->blade->compiler(), $method], $params);
    }

}
