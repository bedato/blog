<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SearchMerchantRequest;
use App\Repositories\Merchant\MerchantsRepositoryInterface;
use App\Http\Resources\MerchantResource;

class MerchantsController extends Controller
{
    protected $merchantRepository;

    /**
     * MerchantsController constructor.
     *
     * @param MerchantsRepositoryInterface $merchantsRepository - Data repository
     */
    public function __construct(
        MerchantsRepositoryInterface $merchantsRepository
    ) {
        $this->merchantsRepository = $merchantsRepository;
    }

    /**
     * Get Merchant list
     *
     * @param SearchMerchantRequest $request - Request validator
     *
     * @return \App\Http\Resources\MerchantResource
     */
    public function index(SearchMerchantRequest $request): MerchantResource
    {
        $merchant = $this->merchantsRepository->getByToken(
            $request->header('X-Access-Token')
        );

        return new MerchantResource($merchant);
    }
}
