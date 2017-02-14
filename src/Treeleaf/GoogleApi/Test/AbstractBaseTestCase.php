<?php

namespace Treeleaf\GoogleApi\Test;

/**
 * Class PlacesApiTest
 */
abstract class AbstractBaseTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @return string
     */
    protected function getTestsDataDir(): string
    {
        return __DIR__ . '/../../../../tests/data/json';
    }

    /**
     * @param string $file
     *
     * @return string
     */
    protected function getTestDataJson(string $file): string
    {
        $dir = $this->getTestsDataDir();

        return file_get_contents($dir . '/' . $file);
    }
}