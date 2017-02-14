<?php

namespace Treeleaf\GoogleApi\Configurator\Places;

use Treeleaf\GoogleApi\Configurator\AbstractConfigurator;

/**
 * Class PlacesConfigurator.
 */
class PlacesAutoCompleteConfigurator extends AbstractConfigurator
{
    const URI_PLACE_AUTOCOMPLETE = '/maps/api/place/autocomplete';

    /**
     * PlacesConfigurator constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        parent::__construct($apiKey);
    }

    /**
     * @param string $format
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    public function getUri(string $format): string
    {
        $this->checkFormat($format);

        return sprintf("%s/%s", self::URI_PLACE_AUTOCOMPLETE, $format);
    }

    /**
     * {@inheritdoc}
     */
    public function getRequiredParameters(): array
    {
        return ['key', 'input'];
    }

    /**
     * {@inheritdoc}
     */
    public function getOptionalParameters(): array
    {
        return ['offset', 'location', 'language', 'types', 'components', 'strictbounds'];
    }
}