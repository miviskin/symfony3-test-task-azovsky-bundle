<?php

namespace Miviskin\AzovskyBundle;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Manager
{
    /**
     * Container
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Sources
     *
     * @var array
     */
    protected $sources = [];

    /**
     * Manager constructor.
     *
     * @param ContainerInterface $container
     * @param array $sources
     */
    public function __construct(ContainerInterface $container, array $sources = [])
    {
        $this->container = $container;
        $this->sources = $sources;
    }

    /**
     * Get currency exchange rate.
     *
     * @param $currency
     * @return mixed
     */
    public function getCurrencyRate($currency)
    {
        foreach ($this->sources as $source) {
            try {

                $source = $this->resolveSource($source);

                if ($source->isAvailableCurrency($currency)) {
                    return $source->getCurrencyRate($currency);
                }

            } catch (Exception\SourceException $e) {}
        }
    }

    /**
     * Resolve source object.
     *
     * @param string $source
     * @return Interfaces\SourceInterface
     *
     * @throws Exception\InvalidSourceException
     */
    public function resolveSource($source)
    {
        if (is_string($source) && class_exists($source)) {
            $source = new $source;

            if ($source instanceof Interfaces\SourceInterface) {
                $source->setContainer($this->container);

                return $source;
            }
        }

        throw new Exception\InvalidSourceException;
    }
}
