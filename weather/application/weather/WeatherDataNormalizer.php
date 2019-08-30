<?php

namespace weather\application\weather;

use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use weather\domain\weather\dto\WeatherData;

/**
 * Сервис нормализации данных о погоде
 */
class WeatherDataNormalizer implements WeatherDataNormalizerInterface
{
    /**
     * @inheritdoc
     *
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function normalize(WeatherData $weatherData): array
    {
        $defaultContext = [
            AbstractNormalizer::CALLBACKS => [
                'onDate' => function ($innerObject, $outerObject, string $attributeName, string $format = null, array $context = []) {
                    return $innerObject instanceof \DateTime ? $innerObject->format('Y-m-d H:i:s') : '';
                },
            ],
        ];

        $getMethodNormalizer = new GetSetMethodNormalizer(null, new CamelCaseToSnakeCaseNameConverter(), null, null, null, $defaultContext);

        return $getMethodNormalizer->normalize($weatherData);
    }
}
