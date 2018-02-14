<?php

/**
 * Kirby Blade Template
 *
 * @version   1.0.0
 * @author    Pedro Borges <oi@pedroborg.es>
 * @copyright Pedro Borges <oi@pedroborg.es>
 * @link      https://github.com/pedroborges/kirby-blade-template
 * @license   MIT
 */

require 'vendor' . DS . 'autoload.php';

kirby()->set('component', 'template', PedroBorges\Blade\Template::class);

function view($template = 'default', $data = []) {
    return PedroBorges\Blade\Compiler::render($template, $data);
}
