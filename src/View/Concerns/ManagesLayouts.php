<?php

namespace PedroBorges\Blade\View\Concerns;

use Illuminate\Contracts\View\View;
use Illuminate\View\Concerns\ManagesLayouts as BaseLayouts;

trait ManagesLayouts
{
    use BaseLayouts {
        BaseLayouts::startSection as parentStartSection;
        BaseLayouts::yieldContent as parentYieldContent;
    }

    /**
     * Start injecting content into a section.
     *
     * @param  string  $section
     * @param  string|null  $content
     * @return void
     */
    public function startSection($section, $content = null)
    {
        if ($content === null) {
            if (ob_start()) {
                $this->sectionStack[] = $section;
            }
        } else {
            $this->extendSection($section, $content instanceof View ? $content : compatible_e($content));
        }
    }

    /**
     * Get the string contents of a section.
     *
     * @param  string  $section
     * @param  string  $default
     * @return string
     */
    public function yieldContent($section, $default = '')
    {
        $sectionContent = $default instanceof View ? $default : compatible_e($default);

        if (isset($this->sections[$section])) {
            $sectionContent = $this->sections[$section];
        }

        $sectionContent = str_replace('@@parent', '--parent--holder--', $sectionContent);

        return str_replace(
            '--parent--holder--',
            '@parent',
            str_replace(static::parentPlaceholder($section), '', $sectionContent)
        );
    }
}
