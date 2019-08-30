<?php

namespace weather\application\weather\provider;

use weather\application\weather\provider\dto\ReceivedWeatherAttributes;
use weather\infrastructure\api\exceptions\ApiException;

/**
 * Интерфейс для получения данных о погоде
 */
interface WeatherDataProviderInterface
{
    /**
     * @param string $location
     *
     * @return ReceivedWeatherAttributes
     *
     * @throws ApiException
     */
    public function getDataByLocation(string $location): ReceivedWeatherAttributes;
}
