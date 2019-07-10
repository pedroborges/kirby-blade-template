<?php

namespace PedroBorges\Blade\View;

use Illuminate\View\Factory as BaseFactory;
use PedroBorges\Blade\View\Concerns\ManagesLayouts;

class Factory extends BaseFactory
{
    use ManagesLayouts;
}
