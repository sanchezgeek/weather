<?php

namespace weather\domain\weather;

use weather\domain\weather\dto\WeatherData;

/**
 * Интерфейс сервиса для получения данных о погодных условиях
 */
interface WeatherServiceInterface
{
    /**
     * Метод возвращает информацию о погодных условиях по переданному имени объекта
     *
     * @param string $location
     *
     * @return WeatherData
     */
    public function getWeatherData(string $location): WeatherData;
}
