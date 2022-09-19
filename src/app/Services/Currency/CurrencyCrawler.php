<?php

namespace App\Services\Currency;

use Illuminate\Support\Collection;

interface CurrencyCrawler
{
    /**
     * @return Collection
     */
    public function getCollection();
}
