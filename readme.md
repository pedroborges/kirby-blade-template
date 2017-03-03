# Kirby Blade Template [![Release](https://img.shields.io/github/release/pedroborges/kirby-blade-template.svg)](https://github.com/pedroborges/kirby-blade-template/releases) [![Issues](https://img.shields.io/github/issues/pedroborges/kirby-blade-template.svg)](https://github.com/pedroborges/kirby-blade-template/issues)

[Laravel Blade](https://laravel.com/docs/master/blade) template component for Kirby CMS.

## Requirements
- Kirby 2.3.2+
- PHP 5.6.4+

## Installation

### Download
[Download the files](https://github.com/pedroborges/kirby-blade-template/archive/master.zip) and place them inside `site/plugins/blade`.

### Kirby CLI
Kirby's [command line interface](https://github.com/getkirby/cli) is the easiest way to install Blade Template:

    $ kirby plugin:install pedroborges/kirby-blade-template

To update it simply run:

    $ kirby plugin:update pedroborges/kirby-blade-template

### Git Submodule
You can add Blade Template as a Git submodule.

<details>
    <summary><strong>Show Git Submodule instructions</strong> 👁</summary><p>

    $ cd your/project/root
    $ git submodule add https://github.com/pedroborges/kirby-blade-template.git site/plugins/blade
    $ git submodule update --init --recursive
    $ git commit -am "Add template component Blade"

Updating is as easy as running a few commands.

    $ cd your/project/root
    $ git submodule foreach git checkout master
    $ git submodule foreach git pull
    $ git commit -am "Update submodules"
    $ git submodule update --init --recursive

</p></details>

## Change Log
All notable changes to this project will be documented at: <https://github.com/pedroborges/kirby-blade-template/blob/master/changelog.md>

## License
Blade Template component is open-sourced software licensed under the [MIT license](http://www.opensource.org/licenses/mit-license.php).

Copyright © 2017 Pedro Borges <oi@pedroborg.es>
