# Kirby Blade Templates [![Release](https://img.shields.io/github/release/pedroborges/kirby-blade-template.svg)](https://github.com/pedroborges/kirby-blade-template/releases) [![Issues](https://img.shields.io/github/issues/pedroborges/kirby-blade-template.svg)](https://github.com/pedroborges/kirby-blade-template/issues)

[Laravel Blade](https://laravel.com/docs/master/blade) template component for Kirby CMS.

> Blade is the simple, yet powerful templating engine provided by Laravel. Unlike other popular PHP templating engines, Blade does not restrict you from using plain PHP code in your views. In fact, all Blade views are compiled into plain PHP code and cached until they are modified, meaning Blade adds essentially zero overhead to your site.

Blade view files use the `.blade.php` file extension and are typically stored in the `site/templates` directory.

**This component extends Kirby's built-in templating engine. Any regular `.php` template will continue to works as usual.**

## Requirements
- Kirby 2.3.2+
- PHP 5.6.4+

## Installation

### Download
[Download the files](https://github.com/pedroborges/kirby-blade-template/archive/master.zip) and place them inside `site/plugins/blade`.

### Kirby CLI
Kirby's [command line interface](https://github.com/getkirby/cli) is the easiest way to install Blade Templates:

    $ kirby plugin:install pedroborges/kirby-blade-template

To update it simply run:

    $ kirby plugin:update pedroborges/kirby-blade-template

### Git Submodule
You can add Blade Templates as a Git submodule.

<details>
    <summary><strong>Show Git Submodule instructions</strong> 👁</summary><p>

    $ cd your/project/root
    $ git submodule add https://github.com/pedroborges/kirby-blade-template.git site/plugins/blade
    $ git submodule update --init --recursive
    $ git commit -am "Add Blade Templates component"

Updating is as easy as running a few commands.

    $ cd your/project/root
    $ git submodule foreach git checkout master
    $ git submodule foreach git pull
    $ git commit -am "Update submodules"
    $ git submodule update --init --recursive

</p></details>

## Basic Usage
Blade Templates works out of the box without requiring any configuration. You just need to add `.blade.php` files to `site/templates`.

### Defining a Layout
Blade uses the concept of [template inheritance](https://laravel.com/docs/master/blade#template-inheritance) and sections. You can define master layouts which are extended by child views. Check out how a master layout would look like in Kirby:

```blade
<!-- Stored in site/templates/layouts/master.blade.php -->

<html>
    <head>
        <title>@yield('title') | {{ $site->title() }}</title>
    </head>
    <body>
        <h1>@yield('title')</h1>

        <div class="sidebar">
            @section('sidebar')
            <h2>Description:</h2>
            @show
        </div>

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
```

As you can see, this file contains typical HTML markup. However, take note of the `@section` and `@yield` directives. The  `@section` directive, as the name implies, defines a section of content, while the `@yield` directive is used to display the contents of a given section.

### Extending a Layout
When defining a child view, use the Blade `@extends` directive to specify which layout the child view should "inherit". Views which extend a Blade layout may inject content into the layout's sections using `@section` directives. Remember, as seen in the example above, the contents of these sections will be displayed in the layout using `@yield`:

```blade
<!-- Stored in site/templates/default.blade.php -->

@extends('layouts.master')

@section('title', $page->title())

@section('sidebar')
    @parent

    {{ $page->description()->kirbytext() }}
@endsection

@section('content')
    $page->text()->kirbytext()
@endsection
```

<details>
    <summary><strong>Show rendered HTML</strong> 👁</summary><p>

```html
<html>
    <head>
        <title>Services | Company Name</title>
    </head>
    <body>
        <h1>Services</h1>

        <div class="sidebar">
            <h2>Description:</h2>
            <p>Service description</p>
        </div>

        <div class="container">
            <p>Sum inusa commolu ptatent mossend elignam volenim quiam quiaspe riaessenis plisita ecaboribus.</p>

            <p>Ecaborenis molupta spiene recepudam, quostium reprem rereprat.</p>
        </div>
    </body>
</html>
```

</p></details>

Notice we didn't use the `html()` method to escape special characters. That's because Blade `{{ }}` statements are automatically sent through Kirby's `html()` helper function to prevent XSS attacks.

If you do **not** want your data to be escaped, you may use the following syntax:

```blade
{!! snippet('posts', $posts, true) !!}
```

> While this example shows how you can use a regular snippet with Blade, take note that Blade's `@include` [directive](https://laravel.com/docs/master/blade#including-sub-views) allows you to include a Blade view from within another view. All variables that are available to the parent view will be made available to the included view as well.

### Directives
You've seem a couple of Blade's directives in this guide but there's [a lot more](https://laravel.com/docs/master/blade#control-structures) available to you:

- `@if`
- `@else`
- `@elseif`
- `@unless`
- `@for`
- `@foreach`
- `@forelse`
- `@empty`
- `@while`
- `@php`
- `@include`
- `@includeIf`
- `@each`
- `@stack`
- `@push`
- [And a few more…](https://laravel.com/docs/master/blade#control-structures)

## Options
### `blade.views`
Path to the `.blade.php` views, defaults to `site/templates`.

### `blade.cache`
Path to views cache, defaults to `site/cache`.

## Change Log
All notable changes to this project will be documented at: <https://github.com/pedroborges/kirby-blade-template/blob/master/changelog.md>

## License
Blade Template component is open-sourced software licensed under the [MIT license](http://www.opensource.org/licenses/mit-license.php).

Copyright © 2017 Pedro Borges <oi@pedroborg.es>
