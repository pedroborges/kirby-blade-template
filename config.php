<?php

use Kirby\Cms\App;
use PedroBorges\Blade\Template;

Kirby::plugin('pedroborges/blade-template', [
    'components' => [
        'template' => function (App $kirby, string $name, array $data = [], string $appendix = null) {
            return new Template($name, $data, $appendix);
        }
    ]
]);
