<?php


namespace App\Traits;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

trait Helper
{

    public function checkPhoneNumberValidation($pattern,$phone)
    {
        $is_valid = preg_match('/'.$pattern.'/', $phone);
        return $is_valid;
    }

    public function generateCodeFromPhoneNumber($phone)
    {
        preg_match('#\((.*?)\)#', $phone, $match);
        return $match[1];

    }
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $pageName = 'page';
        $page     = $page ?: (Paginator::resolveCurrentPage($pageName) ?: 1);
        $items    = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator(
            $items->forPage($page, $perPage)->values(),
            $items->count(),
            $perPage,
            $page,
            [
                'path'     => Paginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]
        );
    }


}
