<?php

namespace weather\domain\weather;

use weather\domain\weather\dto\WeatherData;
use weather\application\weather\provider\WeatherDataProviderInterface;

/**
 * Сервис для получения данных о погодных условиях
 */
class WeatherService implements WeatherServiceInterface
{
    /** @var WeatherDataProviderInterface */
    private $weatherDataProvider;

    /**
     * GetWeatherDataService constructor.
     * @param WeatherDataProviderInterface $weatherDataProvider
     */
    public function __construct(WeatherDataProviderInterface $weatherDataProvider)
    {
        $this->weatherDataProvider = $weatherDataProvider;
    }

    /**
     * @param string $location
     *
     * @return WeatherData
     *
     * @throws \weather\infrastructure\api\exceptions\ApiException
     */
    public function getWeatherData(string $location): WeatherData
    {
        $weatherData = $this->weatherDataProvider->getDataByLocation($location);

        return new WeatherData(
            $location,
            $weatherData->getTemp(),
            $weatherData->getWindSpeed(),
            $weatherData->getWindDeg()
        );
    }
}
