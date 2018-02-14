<?php

namespace PedroBorges\Blade;

use Exception;
use Kirby\Component\Template as BaseTemplate;
use Page;
use Tpl;

class Template extends BaseTemplate
{
    protected $extension = '.blade.php';

    /**
     * Returns a template file path by name
     *
     * @param   string  $name
     * @return  string
     */
    public function file($name)
    {
        $base = $this->kirby->roots()->templates() . DS . str_replace('/', DS, $name);
        $blade = $this->extension;

        if (file_exists($base . $blade)) {
            return $base . $blade;
        } else {
            return $base . '.php';
        }
    }

    /**
     * Returns the template name
     *
     * @param   string  $file
     * @return  string
     */
    public function getTemplateName($file)
    {
        $length = strlen($this->extension);

        return substr($file, strrpos($file, '/') + 1, -$length);
    }

    /**
     * Checks if file extension is .blade.php
     *
     * @param   string  $file
     * @return  boolean
     */
    public function isBlade($file)
    {
        $length = strlen($this->extension);

        return substr($file, -$length) === $this->extension;
    }

    /**
     * Renders the template by page with the additional data
     *
     * @param   Page|string  $template
     * @param   array        $data
     * @param   boolean      $return
     * @return  string
     */
    public function render($template, $data = [], $return = true)
    {
        if ($template instanceof Page) {
            $page = $template;
            $file = $page->templateFile();
            $data = $this->data($page, $data);
        } else {
            $file = $template;
            $data = $this->data(null, $data);
        }

        // check for an existing template
        if (! file_exists($file)) {
            throw new Exception('The template could not be found');
        }

        // merge and register the template data globally
        $tplData = Tpl::$data;
        Tpl::$data = array_merge(Tpl::$data, $data);

        // load the template
        if ($this->isBlade($file)) {
            $view = $this->getTemplateName($file);
            $result = Compiler::render($view, Tpl::$data);
        } else {
            $result = Tpl::load($file, null, $return);
        }

        // reset the template data
        Tpl::$data = $tplData;

        return $result;
    }
}
