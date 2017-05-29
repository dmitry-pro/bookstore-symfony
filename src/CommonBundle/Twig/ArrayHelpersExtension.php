<?php

namespace CommonBundle\Twig;

class ArrayHelpersExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('remove_array_keys', array($this, 'removeArrayKeys')),
        );
    }

    public function removeArrayKeys($data, $keys)
    {
        foreach ($keys as $key) {
            if (isset($data[$key])) {
                unset($data[$key]);
            }
        }

        return $data;
    }
}