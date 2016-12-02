<?php

namespace Miviskin\AzovskyBundle\Sources;

use Miviskin\AzovskyBundle\Exception\SourceException;
use Miviskin\AzovskyBundle\Interfaces\SourceInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DomCrawler\Crawler;

class CbrSource implements SourceInterface
{
    use ContainerAwareTrait;

    /**
     * Available currency.
     *
     * @var array
     */
    protected $availableCurrency = [
        'USDRUB' => 'R01235',
        'EURRUB' => 'R01239',
    ];

    /**
     * Get rate from given currency.
     *
     * @param string $currency
     * @return string
     *
     * @throws SourceException
     */
    public function getCurrencyRate($currency)
    {
        if ($this->isAvailableCurrency($currency)) {

            $crawler = new Crawler(
                file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp')
            );

            $rate = $crawler->filter('Valute[ID=' . $this->availableCurrency[$currency] . '] > Value')->first();

            if ($rate->count()) {
                return $rate->text();
            }

            throw new SourceException("Can't resolve rate for {$currency} in Cbr source.");
        }

        throw new SourceException("{$currency} is not available in Cbr source.");
    }

    /**
     * Check if available currency.
     *
     * @param string $currency
     * @return bool
     */
    public function isAvailableCurrency($currency)
    {
        return array_key_exists($currency, $this->availableCurrency);
    }
}
