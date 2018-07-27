<?php

namespace PedroBorges\Blade;

use Exception;
use Kirby\Cms\App;
use Kirby\Toolkit\F;

class Template extends \Kirby\Cms\Template
{
    protected $blade;
    protected $kirby;

    public function __construct(App $kirby, string $name, string $type = 'html')
    {
        parent::__construct($name, $type);

        // TODO: add more view paths (site/template, resources/view)
        $viewPath    = dirname($this->file());
        $this->blade = new Blade($viewPath);
        $this->kirby = $kirby;
    }

    public function blade()
    {
        return $this->blade;
    }

    public function extension(): string
    {
        return 'blade.php';
    }

    public function isBlade(): bool
    {
        $length = strlen($this->extension());

        return substr($this->file(), -$length) === $this->extension();
    }

    public function file(): ?string
    {
        $viewPath  = $this->root() . '/' . $this->name();
        $bladeView = $viewPath . '.' . $this->extension();

        try {
            try {
                return F::realpath($bladeView, $this->root());
            } catch (Exception $e) {
                // try to load the PHP template
                return F::realpath($viewPath . '.php', $this->root());
            }
        } catch (Exception $e) {
            // try to load the template from the registry
            // TODO: test if it is a blade view
            return $this->kirby->extension(static::$type . 's', $this->name());
        }
    }

    /**
     * Renders the view
     *
     * @return string
     */
    public function render(array $data = []): string
    {
        if ($this->isBlade()) {
            return $this->blade()->render($this->name(), $data);
        }

        return parent::render($data);
    }
}
