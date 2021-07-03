<?php

namespace App\Http\Controllers\Web;

use App\Contracts\CustomerServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $countries = $this->customerService->getListOfCountries();
        return view('welcome', compact('countries'));
    }

}
