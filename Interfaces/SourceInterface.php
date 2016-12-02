<?php

namespace Miviskin\AzovskyBundle\Interfaces;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;

interface SourceInterface extends ContainerAwareInterface
{
    /**
     * Get rate from given currency.
     *
     * @param string $currency
     * @return string
     *
     * @throws \Miviskin\AzovskyBundle\Exception\SourceException
     */
    public function getCurrencyRate($currency);

    /**
     * Check if available currency.
     *
     * @param string $currency
     * @return bool
     */
    public function isAvailableCurrency($currency);
}
