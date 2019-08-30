<?php

namespace weather\infrastructure\weatherDataProvider\openWeather;

use Symfony\Component\HttpClient\HttpClient;
use weather\application\weather\provider\dto\ReceivedWeatherAttributes;
use weather\application\weather\provider\WeatherDataProviderInterface;

/**
 * Сервис для получения данных от OpenWeather
 */
class OpenWeatherDataProvider implements WeatherDataProviderInterface
{
    /** @var OpenWeatherApiInterface API для доступа к сервису */
    private $api;

    /**
     * OpenWeatherDataProvider constructor.
     *
     * @param OpenWeatherApiInterface $api
     */
    public function __construct(OpenWeatherApiInterface $api)
    {
        $this->api = $api;
    }

    /**
     * @param string $location
     *
     * @return ReceivedWeatherAttributes
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \weather\infrastructure\api\exceptions\ApiException
     */
    public function getDataByLocation(string $location): ReceivedWeatherAttributes
    {
        $responseData = $this->api->get('weather', ['q' => $location])->toArray();

        return new ReceivedWeatherAttributes(
            $responseData['main']['temp'],
            $responseData['wind']['speed'],
            $responseData['wind']['deg']
        );
    }

    /**
     * Фабрика для создания OpenWeather-провайдера
     *
     * @param $apiBaseUrl
     * @param $apiKey
     *
     * @return self
     */
    public static function factory($apiBaseUrl, $apiKey): self
    {
        return new static(
            new OpenWeatherApi(new HttpClient(), $apiBaseUrl, $apiKey)
        );
    }
}
