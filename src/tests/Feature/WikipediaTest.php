<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WikipediaTest extends TestCase
{
    /**
     * @return void
     */
    public function test_wikipedia_request()
    {
        $http = Http::get('https://pt.wikipedia.org/wiki/ISO_4217');

        $this->assertEquals(200, $http->status());
    }
}
