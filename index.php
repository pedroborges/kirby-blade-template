<?php

@include_once __DIR__.'/vendor/autoload.php';

use Kirby\Cms\App;
use PedroBorges\Blade\Template;

Kirby::plugin('pedroborges/blade-template', [
    'components' => [
        'template' => function (App $kirby, string $name, string $type = 'html', string $defaultType = 'html') {
            return new Template($name, $type, $defaultType);
        }
    ]
]);
