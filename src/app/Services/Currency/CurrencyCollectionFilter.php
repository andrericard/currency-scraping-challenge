<?php

namespace App\Services\Currency;

use App\Services\Currency\CurrencyCollectionAttributes as Attributes;
use Illuminate\Support\Collection;

trait CurrencyCollectionFilter
{
    /**
     * @param  Collection  $currencyCollecion
     * @param  array  $filters
     * @return Collection
     */
    protected function filterCurrencyCollection(Collection $currencyCollecion, array $filters)
    {
        return $currencyCollecion->filter(function ($currency) use ($filters) {
            return in_array($currency[Attributes::ALPHABETIC_CODE->value], $filters) || in_array($currency[Attributes::NUMERIC_CODE->value], $filters);
        });
    }
}
