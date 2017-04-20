<?php

namespace AppBundle\Twig;

class ArrayExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('exclude_array_keys', array($this, 'excludeArrayKeys')),
        );
    }

    public function excludeArrayKeys($items, $keysToExclude = [])
    {

        return array_filter($items, function($k) use ($keysToExclude) {
            return !in_array($k, $keysToExclude);

        }, ARRAY_FILTER_USE_KEY);
    }

}