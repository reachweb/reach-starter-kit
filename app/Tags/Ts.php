<?php

namespace App\Tags;

use Statamic\Tags\Tags;

class Ts extends Tags
{

    /**
     * The {{ ts:label }} tag gets a translation for the global "trans".
     *
     * @return string|array
     */
    public function wildcard($tag)
    {
        $trans = $this->context->get('translations');
        $strings = $trans['strings']->value();
        if (array_key_exists($tag, $strings)) {
            return $strings[$tag];
        }
    }

    public function index()
    {
        $trans = $this->context->get('translations');
        $strings = $trans['strings']->value();
        $label = $this->params->get('label')->value();
        if (array_key_exists($label, $strings)) {
            return $strings[$label];
        }
    }

    public function json()
    {
        $path = resource_path('lang/').$this->context->get('site').'.json';
        return file_get_contents($path);
    }

}