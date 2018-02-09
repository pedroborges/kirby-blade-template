<?php

namespace PedroBorges\Blade;

use Exception;
use F;
use c;
use Jenssegers\Blade\Blade;
use Kirby;

class Compiler
{
    protected static $instance = null;

    protected $blade;
    protected $compiler;

    public function __construct()
    {
        $this->kirby = Kirby::instance();

        $templates = $this->kirby->roots()->templates();
        $cache = $this->kirby->roots()->cache();

        if (! F::isWritable($cache)) {
            throw new Exception("Cache directory [{$cache}] does not exist or is not writable.");
        }

        $this->blade = new Blade(
            $this->kirby->get('option', 'blade.views', $templates),
            $this->kirby->get('option', 'blade.cache', $cache)
        );

        $this->compiler = $this->blade->compiler();

        $this->setEchoFormat('html(%s)');
        $this->registerDirectives();

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
     * Returns the Blade's compiler
     *
     * @return \Illuminate\View\Compilers\BladeCompiler
     */
    public function compiler()
    {
        return $this->compiler;
    }

     /**
     * Registers custom directives for Kirby
     *
     * @return void
     */
    public function registerDirectives()
    {
        $this->directive('css', function ($path) {
            return "<?php echo css($path) ?>";
        });

        $this->directive('js', function ($path) {
            return "<?php echo js($path) ?>";
        });

        if ($directives = c::get('blade.directives')){
            foreach ($directives as $directiveKey => $directive) {
                $this->directive($directiveKey, $directive);
            }
        }        
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
        return call_user_func_array([$this->compiler(), $method], $params);
    }

}
