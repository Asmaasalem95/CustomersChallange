<?php


namespace App\Repositories;


use App\Contracts\CustomerRepositoryInterface;
use App\Http\Resources\CustomerResourceWithStateCheck;
use App\Models\Customer;
use App\Utilities\Filters\CountryCodeFilter;
use App\Utilities\Filters\StateFilter;
use Illuminate\Http\Response;

class CustomerRepository implements CustomerRepositoryInterface
{

    /**
     * @var Customer
     */
    private $customerModel;

    /**
     * CustomerRepository constructor.
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customerModel = $customer;
    }

    /**
     * @param array $filters
     * @return Customer|\Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed|object
     */
    public function filter(array $filters)
    {
        // TODO: Implement filter() method.
        $data = $this->customerModel;

        try {
            if (isset($filters['code'])) {
                $code = str_replace('+', '', $filters['code']);
                $data = CountryCodeFilter::apply($data, $code);
            }
            $data = CustomerResourceWithStateCheck::collection($data->get());
            //filter by state after check validation
            if (isset($filters['state'])) {
                $data = StateFilter::apply(Collect($data), $filters['state'])->values();
            }
            return $data;
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'Error!',
                'response' => $exception->getMessage(),
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

    }


}
