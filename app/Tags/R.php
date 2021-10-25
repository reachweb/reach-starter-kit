<?php

namespace App\Tags;

use Statamic\Tags\Tags;
use Statamic\Facades\Blueprint;
use Statamic\Facades\Term;
use Statamic\Facades\Form;
use Statamic\Facades\Site;
use Statamic\Facades\Data;

class R extends Tags
{

    /**
	 * Get the terms for a taxonomy
	 */
	private function taxonomyTerms($handle)
	{
		$terms = [];
		foreach(Term::whereTaxonomy($handle) as $term) {
			$terms[$term->slug()] = $term->title();
		}
		return $terms;
	}

	public function random()
    {
        $max = $this->params->int('max', 10);
        return rand(1, $max);
    }

    public function locales()
	{
		$locales = Site::all()->map(function ($locale, $key) {
					return $this->getLocale($key);
				})->pipe(function ($locales) {
					return $this->addData($locales);
				})->filter()->values();
		return json_encode($locales);
	}

	public function form()
	{
		$formHandle = $this->params->get('name');		
        $form = Form::find($formHandle);
		$fields = $form->fields()->values();
		$url = route('statamic.forms.submit', $formHandle);
        $honeypot = $form->honeypot();
        // If we have a country field add the names automatically
        foreach ($fields as $index => $field) {
            if ($field->handle() == 'country') {
                $config = $field->config();
                $config['options'] = trans('countries');
                $field->setConfig($config);
            }
        }
		$fields = $fields->toArray();
        return htmlspecialchars(json_encode(compact('url', 'honeypot', 'fields'), JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8');
	}

    private function getLocale($key)
    {
        $site = $key instanceof \Statamic\Sites\Site ? $key : Site::get($key);

        return [
            'key' => $site->handle(),
            'handle' => $site->handle(),
            'name' => $site->name(),
            'full' => $site->locale(),
            'short' => $site->shortLocale(),
        ];
    }

    /**
     * Add data to the locale collection.
     *
     * @param  Collection  $locales
     */
    private function addData($locales)
    {
        return $locales->map(function ($locale, $key) {
            if (! $localized = $this->getLocalizedData($key)) {
                return null;
            }

            $local['locale'] = $locale;
            $local['current'] = Site::current()->handle();
            $local['is_current'] = $key === Site::current()->handle();
            $local['permalink'] = $localized['permalink'];

            return $local;
        });
    }	
	/**
     * Get the localized version of the data object as an array.
     *
     * @param  string  $locale
     * @return array
     */
    private function getLocalizedData($locale)
    {
        if (! $data = $this->getData()) {
            return null;
        }

        if (! $localized = $data->in($locale)) {
            return null;
        }

        if (method_exists($localized, 'published') && ! $localized->published()) {
            return null;
        }

        return $localized->toAugmentedArray();
    }

    /**
     * Get the data / content object.
     *
     * @return \Statamic\Contracts\Data\Content\Content
     */
    private function getData()
    {
        $id = $this->params->get('id', $this->context->get('id'));

        return $this->data = Data::find($id);
    }

}