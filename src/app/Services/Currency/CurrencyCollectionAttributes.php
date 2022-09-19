<?php

namespace App\Services\Currency;

enum CurrencyCollectionAttributes: string
{
    case ALPHABETIC_CODE = 'alphabetic_code';
    case NUMERIC_CODE = 'numeric_code';
    case MINOR_UNITS = 'minor_units';
    case CURRENCY_NAME = 'currency_name';
    case COUNTRIES = 'countries';
}
