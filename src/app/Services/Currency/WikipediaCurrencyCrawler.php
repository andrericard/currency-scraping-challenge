<?php

namespace App\Services\Currency;

use App\Services\Currency\CurrencyCollectionAttributes as Attributes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class WikipediaCurrencyCrawler implements CurrencyCrawler
{
    /**
     * @var string
     */
    private string $url = 'https://pt.wikipedia.org/wiki/ISO_4217';

    /**
     * @var string
     */
    private string $tableSelector = '#mw-content-text > div.mw-parser-output > table:nth-child(8) > tbody';

    /**
     * @return Collection
     */
    public function getCollection()
    {
        $currencyCollection = collect(
            $this->parseTable()
        );

        $currencyCollection->shift();

        return $currencyCollection;
    }

    /**
     * @return array
     */
    private function parseTable()
    {
        return $this->getCrawler()
            ->filter($this->tableSelector)
            ->children()
            ->each(fn(Crawler $node) => $this->parseRow($node->children()));
    }

    /**
     * @return Crawler
     */
    private function getCrawler()
    {
        return new Crawler($this->getNode());
    }

    /**
     * @return string
     */
    private function getNode()
    {
        return Http::get($this->url)
            ->onError(fn($callback) => $callback->throw())
            ->body();
    }

    /**
     * @param  Crawler  $node
     * @return array
     */
    private function parseRow(Crawler $node)
    {
        return [
            Attributes::ALPHABETIC_CODE->value => $this->getText($node, 0),
            Attributes::NUMERIC_CODE->value => $this->getText($node, 1),
            Attributes::MINOR_UNITS->value => $this->getText($node, 2),
            Attributes::CURRENCY_NAME->value => $this->getText($node, 3),
            Attributes::COUNTRIES->value => $this->listedCountries($this->getText($node, 4)),
        ];
    }

    /**
     * @param  Crawler  $node
     * @param $position
     * @return mixed
     */
    private function getText(Crawler $node, $position)
    {
        return $node->eq($position)->text();
    }

    /**
     * @param  string  $countries
     * @return array
     */
    private function listedCountries(string $countries)
    {
        return Str::of($countries)->explode(',')->sort()->values();
    }
}
