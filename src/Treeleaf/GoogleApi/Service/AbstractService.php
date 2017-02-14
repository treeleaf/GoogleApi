<?php

namespace Treeleaf\GoogleApi\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Treeleaf\GoogleApi\Configurator\ConfiguratorCollectionInterface;
use Treeleaf\GoogleApi\Configurator\ConfiguratorInterface;

/**
 * Class AbstractService.
 */
abstract class AbstractService
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var ConfiguratorCollectionInterface
     */
    protected $collection;

    /**
     * AbstractService constructor.
     *
     * @param ConfiguratorCollectionInterface $collection
     * @param Client|null                     $client
     */
    public function __construct(ConfiguratorCollectionInterface $collection, Client $client = null)
    {
        if (is_null($client)) {
            $client = new Client();
        }
        $this->client = $client;
        $this->collection = $collection;
    }

    /**
     * @param string $serviceName
     *
     * @return ConfiguratorInterface
     */
    public function getConfigurator(string $serviceName): ConfiguratorInterface
    {
        $collection = $this->collection->getConfigurators();
        if (! isset($collection[$serviceName])) {
            throw new \InvalidArgumentException(sprintf("Service does not exists %s"));
        }

        return $collection[$serviceName];
    }

    /**
     * @param ConfiguratorInterface $configurator
     * @param array                 $params
     * @param string                $format
     * @param array                 $options
     *
     * @return Response
     */
    public function makeRequest(ConfiguratorInterface $configurator, array $params, $format = 'json', array $options = []): Response
    {
        $options = array_merge($configurator->getConfig(), $params, $options);
        $uri = sprintf("%s://%s/%s", $configurator->getScheme(), $configurator->getHost(), $configurator->getUri($format));

        $diff = array_diff($configurator->getRequiredParameters(), array_keys($options));
        if (count($diff)) {
            throw new \InvalidArgumentException(sprintf("Missing parameters: %s", join(', ', $diff)));
        }

        return $this->client->request('GET', $uri, ['query' => $options]);
    }
}