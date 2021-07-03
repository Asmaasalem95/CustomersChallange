<?php


namespace App\Utilities\Filters;


use App\Contracts\FilterInterface;
use App\Traits\Helper;

class StateFilter implements FilterInterface
{

    use  Helper;
    /**
     * @inheritDoc
     */
    public static function apply($data, $value)
    {
        // TODO: Implement apply() method.
       return  $data->where('is_valid',$value);
    }
}
