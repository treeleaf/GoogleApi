<?php

namespace Treeleaf\GoogleApi\Service\Places;

use Treeleaf\GoogleApi\Service\AbstractService;

/**
 * Class PlacesApi.
 */
class PlacesApi extends AbstractService
{
    const CONFIGURATOR_SERVICE_PLACE_AUTO_COMPLETE = 'service.placeAutoComplete';
    const CONFIGURATOR_SERVICE_PLACE_DETAIL = 'service.placeDetail';

    /**
     * @param string $query
     * @param array  $args
     * @param string $format
     *
     * @return string
     */
    public function placeAutoComplete(string $query, array $args = [], string $format = 'json'): string
    {
        $configurator = $this->getConfigurator(self::CONFIGURATOR_SERVICE_PLACE_AUTO_COMPLETE);

        $result = $this->makeRequest($configurator, ['input' => $query], $format, $args);
        $response = (string) $result->getBody()->getContents();

        return $response;
    }
    /**
     * @param string $placeId
     * @param array  $args
     * @param string $format
     *
     * @return string
     */
    public function placeDetails(string $placeId, array $args = [], string $format = 'json'): string
    {
        $configurator = $this->getConfigurator(self::CONFIGURATOR_SERVICE_PLACE_DETAIL);

        $result = $this->makeRequest($configurator, ['placeid' => $placeId], $format, $args);
        $response = (string) $result->getBody()->getContents();

        return $response;
    }
}