<?php

namespace weather\infrastructure\weatherDataProvider\openWeather;

use \Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;
use weather\infrastructure\api\exceptions\ApiException;
use weather\infrastructure\api\exceptions\BadRequestException;
use weather\infrastructure\api\exceptions\ForbiddenException;
use weather\infrastructure\api\exceptions\InternalErrorException;
use weather\infrastructure\api\exceptions\NotFoundException;
use weather\infrastructure\api\exceptions\UnauthorizedException;

/**
 * Сервис для работы с OpenWeather API
 */
class OpenWeatherApi implements OpenWeatherApiInterface
{
    /** @var HttpClient */
    protected $httpClient;

    /** @var string Базовый url для доступа к API */
    protected $apiBaseUrl;

    /** @var string Секретный ключ для доступа к API */
    protected $apiKey;

    /**
     * OpenWeatherApi constructor.
     *
     * @param HttpClient $httpClient
     * @param $apiBaseUrl
     * @param $apiKey
     */
    public function __construct(HttpClient $httpClient, $apiBaseUrl, $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->apiBaseUrl = $apiBaseUrl;
        $this->apiKey = $apiKey;
    }

    /**
     * @inheritdoc
     *
     * @throws BadRequestException
     * @throws ForbiddenException
     * @throws InternalErrorException
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function get($method, $params): ResponseInterface
    {
        $url = (rtrim($this->apiBaseUrl, '/') . '/' . $method);
        $response = $this->httpClient::create()->request('GET', $url, [
            'query' => array_merge($params, [
                'APPID' => $this->apiKey,
                'units' => 'metric',
            ])
        ]);
        $code = $response->getStatusCode();

        if ($code !== 200) {
            switch ($code) {
                case 400:
                    throw new BadRequestException();
                case 401:
                    throw new UnauthorizedException();
                case 403:
                    throw new ForbiddenException();
                case 404:
                    throw new NotFoundException();
                case 500:
                    throw new InternalErrorException();
                default:
                    throw new ApiException();
            }
        }

        return $response;
    }
}
