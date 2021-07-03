<?php


namespace App\Utilities\Filters;


use App\Contracts\FilterInterface;

class CountryCodeFilter implements FilterInterface
{

    /**
     * @inheritDoc
     */
    public static function apply($data, $value)
    {
        // TODO: Implement apply() method.

        return $data->where('phone','like','%'.'('.$value.')'.'%');

    }
}
