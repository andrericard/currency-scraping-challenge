<?php

namespace App\Services\Currency;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CurrencyService
{
    use CurrencyCollectionFilter;

    /**
     * @var CurrencyCrawler
     */
    private CurrencyCrawler $currencyCrawler;

    /**
     * CurrencyService constructor.
     *
     * @param  CurrencyCrawler  $currencyCrawler
     */
    public function __construct(CurrencyCrawler $currencyCrawler)
    {
        $this->currencyCrawler = $currencyCrawler;
    }

    /**
     * @param  array|null  $filters
     * @return Collection
     */
    public function getFilteredCurrencies(?array $filters)
    {
        $currencyCollection = $this->getCachedCurrencyCollection();

        return filled($filters)
            ? $this->filterCurrencyCollection($currencyCollection, $filters)
            : $currencyCollection;
    }

    /**
     * @return Collection
     */
    private function getCachedCurrencyCollection()
    {
        return Cache::get('currencies', function () {
            $currencyCollection = $this->currencyCrawler->getCollection();

            Cache::add('currencies', $currencyCollection, now()->addHour());

            return $currencyCollection;
        });
    }
}
