<?php

namespace App\Http\Controllers\Api;

use App\Contracts\CustomerServiceInterface;
use App\Http\Requests\filterCustomersRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Helper;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    use Helper;
    /**
     * @var CustomerServiceInterface
     */
    private $customerService;

    /**
     * CustomerController constructor.
     * @param CustomerServiceInterface $customerService
     */
    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * @param filterCustomersRequest $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function index(filterCustomersRequest $request)
    {

        $filters = $request->query();

        try {
            $customers = $this->customerService->getFilteredCustomers($filters);
            $customersPaginated = $this->paginate($customers);
            return response()->json([
                'status' => 'Success',
                'data' => $customersPaginated,
            ])->setStatusCode(Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Error',
                'response' => $e->getMessage(),
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

    }
}
