<?php

namespace Miviskin\AzovskyBundle\Sources;

use Miviskin\AzovskyBundle\Exception\SourceException;
use Miviskin\AzovskyBundle\Interfaces\SourceInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class YahooSource implements SourceInterface
{
    use ContainerAwareTrait;

    /**
     * Available currency.
     *
     * @var array
     */
    protected $availableCurrency = [
        'USDRUB' => 'USDRUB',
        'EURRUB' => 'EURRUB',
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

            $json = file_get_contents(
                'https://query.yahooapis.com/v1/public/yql'
                    . '?q=select+*+from+yahoo.finance.xchange+where+pair+=+%22USDRUB,EURRUB%22'
                    . '&format=json'
                    . '&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback'
            );

            $data = json_decode($json, true);

            if (json_last_error() == JSON_ERROR_NONE) {
                foreach ($data['query']['results']['rate'] as $rate) {
                    if ($rate['id'] === $this->availableCurrency[$currency]) {
                        return $rate['Rate'];
                    }
                }
            }

            throw new SourceException("Can't resolve rate for {$currency} in Yahoo source.");
        }

        throw new SourceException("{$currency} is not available in Yahoo source.");
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
