<?php

namespace Treeleaf\GoogleApi\Service\Places;

use Treeleaf\GoogleApi\Configurator\Places\PlacesAutoCompleteConfigurator;
use Treeleaf\GoogleApi\Service\AbstractService;

/**
 * Class PlacesApi.
 */
class PlacesApi extends AbstractService
{
    const CONFIGURATOR_SERVICE_PLACE_AUTO_COMPLETE = 'service.placeAutoComplete';

    /**
     * @var PlacesAutoCompleteConfigurator
     */
    protected $placesAutoCompleteConfigurator;

    /**
     * @param string $query
     *
     * @return string
     */
    public function placeAutoComplete(string $query): string
    {
        $configurator = $this->getConfigurator(self::CONFIGURATOR_SERVICE_PLACE_AUTO_COMPLETE);

        $result = $this->makeRequest($configurator, ['input' => $query]);
        $response = (string) $result->getBody()->getContents();

        return $response;
    }
}