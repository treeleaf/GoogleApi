<?php

namespace Tests\Treeleaf\GoogleApi\Service\Places;

use Treeleaf\GoogleApi\Bootstrap;
use Treeleaf\GoogleApi\Configurator\AbstractConfigurator;
use Treeleaf\GoogleApi\Configurator\Places\PlacesDetailConfigurator;
use Treeleaf\GoogleApi\Test\AbstractBaseTestCase;
use Treeleaf\GoogleApi\Configurator\ConfiguratorCollection;
use Treeleaf\GoogleApi\Configurator\Places\PlacesAutoCompleteConfigurator;
use Treeleaf\GoogleApi\Service\Places\PlacesApi;

/**
 * Class PlacesApiTest
 */
class PlacesApiTest extends AbstractBaseTestCase
{
    /**
     * Test Place auto complete function.
     */
    public function testPlaceAutoComplete()
    {
        $jsonDir = $this->getTestsDataDir();
        $jsonFile = 'service.places.placesApi.placeAutocomplete.json';
        $json = $this->getTestDataJson($jsonFile);

        $streamMock = $this->getMockBuilder('GuzzleHttp\Psr7\Stream')
            ->disableOriginalConstructor()
            ->setMethods(['getContents'])
            ->getMock()
        ;
        $streamMock->expects($this->once())->method('getContents')->willReturn($json);

        $responseMock = $this->getMockBuilder('GuzzleHttp\Psr7\Response')
            ->disableOriginalConstructor()
            ->setMethods(['getBody'])
            ->getMock()
        ;
        $responseMock->expects($this->once())->method('getBody')->willReturn($streamMock);

        $httpClientMock = $this->getMockBuilder('GuzzleHttp\Client')
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock()
        ;
        $httpClientMock
            ->expects($this->once())
            ->method('request')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo(sprintf("%s://%s/%s/json", AbstractConfigurator::DEFAULT_SCHEME, AbstractConfigurator::HOST_GOOGLE_MAPS, PlacesAutoCompleteConfigurator::URI_PLACE_AUTOCOMPLETE)),
                $this->equalTo(['query' => [
                    'key'   => 'DummyKey',
                    'input' => 'Paris'
                ]])
            )
            ->willReturn($responseMock)
        ;

        $collection = $this->getConfiguratorCollection();
        $placesApiService = new PlacesApi($collection, $httpClientMock);


        $result = $placesApiService->placeAutoComplete('Paris');


        $this->assertJsonStringEqualsJsonFile($jsonDir . '/' . $jsonFile, $result);
    }

    /**
     * Test Place auto complete function.
     */
    public function testPlaceDetails()
    {
        $jsonDir = $this->getTestsDataDir();
        $jsonFile = 'service.places.placesApi.placeDetails.json';
        $json = $this->getTestDataJson($jsonFile);

        $streamMock = $this->getMockBuilder('GuzzleHttp\Psr7\Stream')
            ->disableOriginalConstructor()
            ->setMethods(['getContents'])
            ->getMock()
        ;
        $streamMock->expects($this->once())->method('getContents')->willReturn($json);

        $responseMock = $this->getMockBuilder('GuzzleHttp\Psr7\Response')
            ->disableOriginalConstructor()
            ->setMethods(['getBody'])
            ->getMock()
        ;
        $responseMock->expects($this->once())->method('getBody')->willReturn($streamMock);

        $httpClientMock = $this->getMockBuilder('GuzzleHttp\Client')
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock()
        ;
        $httpClientMock
            ->expects($this->once())
            ->method('request')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo(sprintf("%s://%s/%s/json", AbstractConfigurator::DEFAULT_SCHEME, AbstractConfigurator::HOST_GOOGLE_MAPS, PlacesDetailConfigurator::URI_PLACE_DETAIL)),
                $this->equalTo(['query' => [
                    'key'     => 'DummyKey',
                    'placeid' => 'ChIJD7fiBh9u5kcRYJSMaMOCCwQ'
                ]])
            )
            ->willReturn($responseMock)
        ;

        $collection = $this->getConfiguratorCollection();
        $placesApiService = new PlacesApi($collection, $httpClientMock);


        $result = $placesApiService->placeDetails('ChIJD7fiBh9u5kcRYJSMaMOCCwQ');


        $this->assertJsonStringEqualsJsonFile($jsonDir . '/' . $jsonFile, $result);
    }

    /**
     * @return ConfiguratorCollection
     */
    protected function getConfiguratorCollection(): ConfiguratorCollection
    {
        $bootstrap = new Bootstrap();

        return $bootstrap->getConfiguratorCollection('DummyKey');
    }
}