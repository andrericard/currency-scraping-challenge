<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    /**
     * @return void
     */
    public function test_that_aplhabetic_code_from_brazilian_currency()
    {
        $http = Http::get('http://localhost/api/currencies?filters[]=BRL');

        $alphabeticCode = collect($http->json('data'))->first()['alphabetic_code'];

        $this->assertEquals('BRL', $alphabeticCode);
    }

    /**
     * @return void
     */
    public function test_that_numeric_code_from_brazilian_currency()
    {
        $http = Http::get('http://localhost/api/currencies?filters[]=BRL');

        $numericCode = collect($http->json('data'))->first()['numeric_code'];

        $this->assertEquals('986', $numericCode);
    }
}
