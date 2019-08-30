<?php

namespace weather\infrastructure\weatherDataProvider\openWeather;

use Symfony\Contracts\HttpClient\ResponseInterface;
use weather\infrastructure\api\exceptions\ApiException;

/**
 * Интерфейс для работы с OpenWeatherApi
 */
interface OpenWeatherApiInterface
{
    /**
     * Получение данных из api
     *
     * @param string $method Название метода, например 'weather'
     * @param array $params Параметры запроса
     *
     * @return ResponseInterface
     *
     * @throws ApiException
     */
    public function get($method, $params): ResponseInterface;
}
