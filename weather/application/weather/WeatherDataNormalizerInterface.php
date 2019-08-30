<?php

namespace weather\application\weather;

use weather\domain\weather\dto\WeatherData;

/**
 * Интерфейс сервиса нормализации данных о погоде
 */
interface WeatherDataNormalizerInterface
{
    /**
     * Нормализация данных о погоде для последующего использования
     *
     * @param WeatherData $weatherData
     *
     * @return array
     */
    public function normalize(WeatherData $weatherData): array;
}
