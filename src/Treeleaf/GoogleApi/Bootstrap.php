<?php

namespace Treeleaf\GoogleApi;

use Treeleaf\GoogleApi\Configurator\ConfiguratorCollection;
use Treeleaf\GoogleApi\Configurator\Places\PlacesAutoCompleteConfigurator;
use Treeleaf\GoogleApi\Configurator\Places\PlacesDetailConfigurator;
use Treeleaf\GoogleApi\Service\Places\PlacesApi;

/**
 * Class Bootstrap.
 */
class Bootstrap
{
    /**
     * @param string $apiKey
     *
     * @return ConfiguratorCollection
     */
    public function getConfiguratorCollection(string $apiKey): ConfiguratorCollection
    {
        $collection = new ConfiguratorCollection();
        $collection->addConfigurator(
            PlacesApi::CONFIGURATOR_SERVICE_PLACE_AUTO_COMPLETE,
            new PlacesAutoCompleteConfigurator($apiKey)
        );
        $collection->addConfigurator(
            PlacesApi::CONFIGURATOR_SERVICE_PLACE_DETAIL,
            new PlacesDetailConfigurator($apiKey)
        );

        return $collection;
    }
}