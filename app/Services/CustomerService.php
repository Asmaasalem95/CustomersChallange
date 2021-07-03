<?php


namespace App\Services;


use App\Contracts\CustomerRepositoryInterface;
use App\Contracts\CustomerServiceInterface;

class CustomerService implements CustomerServiceInterface
{

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepo;

    /**
     * CustomerService constructor.
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepo = $customerRepository;
    }


    /**
     * @param array $filters
     * @return mixed
     */
    public function getFilteredCustomers(array $filters)
    {
        // TODO: Implement getFilteredCustomers() method.

        return $this->customerRepo->filter($filters);
    }

    /**
     * @return array
     */
    public function getListOfCountries() :array
    {
        $countries = [];
        foreach (config('codes') as $code)
        {
            array_push($countries,['country' => $code['country'],'code'=> $code['code']]);
        }
        return $countries;
    }


}
