<?php


namespace App\Contracts;


use phpDocumentor\Reflection\Types\Object_;

interface CustomerServiceInterface
{

    public function getFilteredCustomers(array  $filters);

    public function getListOfCountries() :array ;

}
