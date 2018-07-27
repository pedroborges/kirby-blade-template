<?php

use Kirby\Cms\App;
use PedroBorges\Blade\Template;

Kirby::plugin('pedroborges/blade-template', [
    'components' => [
        'template' => function (App $kirby, string $name, string $type = 'html') {
            return new Template($kirby, $name, $type);
        }
    ]
]);
