<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CurrencyRequest;
use App\Http\Resources\Api\CurrencyCollection;
use App\Services\Currency\CurrencyService;

class CurrencyController extends Controller
{
    /**
     * Currency service.
     *
     * @var CurrencyService
     */
    private CurrencyService $currencyService;

    /**
     * CurrencyController constructor.
     *
     * @param  CurrencyService  $currencyService
     */
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * Returns a list of currencies.
     *
     * @param  CurrencyRequest  $request
     * @return CurrencyCollection
     */
    public function listCurrencies(CurrencyRequest $request)
    {
        try {
            return new CurrencyCollection(
                $this->currencyService->getFilteredCurrencies($request->filters)
            );
        } catch (\Exception) {
            abort(503, 'Serviço indisponível.');
        }
    }
}
