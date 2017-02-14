<?php

namespace Treeleaf\GoogleApi\Configurator;

/**
 * Interface ConfiguratorInterface
 */
interface ConfiguratorInterface
{
    /**
     * @param string $format
     *
     * @return string
     */
    public function getUri(string $format): string;

    /**
     * @return string
     */
    public function getHost(): string;

    /**
     * @return string
     */
    public function getScheme(): string;

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return $this
     */
    public function addConfigParameter(string $key, $value);

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getConfigParameter(string $key);

    /**
     * Get configuration
     *
     * @return array
     */
    public function getConfig(): array;

    /**
     * @return array
     */
    public function getRequiredParameters(): array;

    /**
     * @return array
     */
    public function getOptionalParameters(): array;
}