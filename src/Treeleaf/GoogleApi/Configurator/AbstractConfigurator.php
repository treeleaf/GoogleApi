<?php

namespace Treeleaf\GoogleApi\Configurator;

/**
 * Class BaseConfigurator
 */
abstract class AbstractConfigurator implements ConfiguratorInterface
{
    const HOST_GOOGLE_MAPS = 'maps.googleapis.com';
    const DEFAULT_SCHEME = 'https';

    /**
     * @var array
     */
    protected $config = [];

    /**
     * BaseConfigurator constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->addConfigParameter('key', $apiKey);
    }

    /**
     * {@inheritdoc}
     */
    public function getScheme(): string
    {
        return self::DEFAULT_SCHEME;
    }

    /**
     * {@inheritdoc}
     */
    public function getHost(): string
    {
        return self::HOST_GOOGLE_MAPS;
    }

    /**
     * {@inheritdoc}
     */
    public function addConfigParameter(string $key, $value)
    {
        $this->config[$key] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigParameter(string $key)
    {
        if (! isset($this->config[$key])) {
            return null;
        }

        return $this->config[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param string $format
     */
    protected function checkFormat($format)
    {
        if (! in_array($format, ['json', 'xml'])) {
            throw new \InvalidArgumentException(sprintf("%s is not a valid format", $format));
        }
    }
}