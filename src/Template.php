<?php

namespace PedroBorges\Blade;

use Exception;
use Kirby\Cms\App;
use Kirby\Cms\Template as BaseTemplate;
use Kirby\Toolkit\F;

class Template extends BaseTemplate
{
    protected $blade;
    protected $cachePath;

    public function __construct(string $name, string $type = 'html', string $defaultType = 'html')
    {
        parent::__construct($name, $type, $defaultType);

        $this->cachePath = option(
            'pedroborges.blade-template.cache',
            kirby()->roots()->cache()
        );
    }

    public function blade(): Blade
    {
        return $this->blade = is_null($this->blade)
            ? new Blade($this->root(), $this->cachePath)
            : $this->blade;
    }

    public function bladeExtension(): string
    {
        return 'blade.php';
    }

    public function getFilepath($name = null): string
    {
        $filename = $name ?? $this->name();

        try {
            return F::realpath($this->root().'/'.$filename.'.'.$this->bladeExtension(), $this->root());
        } catch (Exception $e) {
            return F::realpath($this->root().'/'.$filename.'.'.$this->extension(), $this->root());
        }
    }

    public function isBlade(): bool
    {
        $length = strlen($this->bladeExtension());

        return substr($this->file(), -$length) === $this->bladeExtension();
    }

    public function file(): ?string
    {
        if ($this->hasDefaultType() === true) {
            try {
                // Try the default template in the default template directory.
                return $this->getFilepath();
            } catch (Exception $e) {
                //
            }

            // Look for the default template provided by an extension.
            $path = App::instance()->extension($this->store(), $this->name());

            if ($path !== null) {
                return $path;
            }
        }

        $name = $this->name().'.'.$this->type();

        try {
            // Try the template with type extension in the default template directory.
            return $this->getFilepath($name);
        } catch (Exception $e) {
            // Look for the template with type extension provided by an extension.
            // This might be null if the template does not exist.
            return App::instance()->extension($this->store(), $name);
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
