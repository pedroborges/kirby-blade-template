<?php

namespace PedroBorges\Blade\View\Compilers;

use Illuminate\View\Compilers\BladeCompiler as BaseCompiler;
use Illuminate\View\Compilers\CompilerInterface;

class BladeCompiler extends BaseCompiler implements CompilerInterface
{

    /**
     * The "regular" / legacy echo string format.
     *
     * @var string
     */
    protected $echoFormat = 'compatible_e(%s)';

    /**
     * Set the "echo" format to double encode entities.
     *
     * @return void
     */
    public function withDoubleEncoding()
    {
        $this->setEchoFormat('compatible_e(%s, true)');
    }

    /**
     * Set the "echo" format to not double encode entities.
     *
     * @return void
     */
    public function withoutDoubleEncoding()
    {
        $this->setEchoFormat('compatible_e(%s, false)');
    }
}
