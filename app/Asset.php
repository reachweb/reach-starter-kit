<?php

namespace App;

use Statamic\Facades\Image;

class Asset extends \Statamic\Assets\Asset
{
    public function toAugmentedArray($keys = null)
    {	
        return (array_merge(parent::toAugmentedArray(), $this->getPresetImages()));
    }

    protected function shallowAugmentedArrayKeys()
    {	
        return array_merge(parent::shallowAugmentedArrayKeys(), [
            'focus_css'
        ]);
    } 

    public function toShallowAugmentedCollection($keys = null)
    {	
    	return parent::toShallowAugmentedCollection()->merge($this->getPresetImages());
    }

    protected function getPresetImages()
    {
    	$presets = config('statamic.assets.image_manipulation.presets');
    	$manipulator = Image::manipulate($this);
		$presetSizes = [];
		foreach ($presets as $preset => $value) {
			$manipulator->p($preset);
			$presetSizes[$preset] = $manipulator->build();
		}
		return $presetSizes;
    }
}