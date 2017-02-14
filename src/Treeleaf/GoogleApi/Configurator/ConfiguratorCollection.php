<?php

namespace Treeleaf\GoogleApi\Configurator;

/**
 * Class ConfiguratorCollection.
 */
class ConfiguratorCollection implements ConfiguratorCollectionInterface
{
    /**
     * @var
     */
    protected $configurators = [];


    /**
     * {@inheritdoc}
     */
    public function addConfigurator(string $serviceName, ConfiguratorInterface $configurator)
    {
        $this->configurators[$serviceName] = $configurator;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigurators(): array
    {
        return $this->configurators;
    }
}