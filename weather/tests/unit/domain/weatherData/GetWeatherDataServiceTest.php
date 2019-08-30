<?php

namespace weather\tests\unit\application\weatherData;

use Codeception\Stub;
use weather\application\weather\provider\dto\ReceivedWeatherAttributes;
use weather\domain\weather\WeatherService;
use weather\application\weather\provider\WeatherDataProviderInterface;

class GetWeatherDataServiceTest extends \Codeception\Test\Unit
{
    /**
     * @dataProvider sampleDataProvider
     */
    public function testServiceReturnCorrectData(string $expectedLocation, float $expectedTemp, int $expectedWindSpeed, int $expectedWindDeg)
    {
        // prepare
        /** @var WeatherDataProviderInterface $weatherDataProvider */
        $weatherDataProvider = Stub::makeEmpty(WeatherDataProviderInterface::class, [
            'getDataByLocation' => new ReceivedWeatherAttributes(
                $expectedTemp,
                $expectedWindSpeed,
                $expectedWindDeg
            )
        ]);
        $getWeatherDataService = new WeatherService($weatherDataProvider);

        // act
        $result = $getWeatherDataService->getWeatherData($expectedLocation);

        // assert
        $this->assertEquals($result->getLocation(), $expectedLocation);
        $this->assertEquals($result->getTemp(), $expectedTemp);
        $this->assertEquals($result->getWindSpeed(), $expectedWindSpeed);
        $this->assertEquals($result->getWindDeg(), $expectedWindDeg);
    }

    public function sampleDataProvider()
    {
        return [
            ['Москва', 22.21, 5, 270]
        ];
    }
}
