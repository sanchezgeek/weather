<?php

if (!isset($argv[1])) {
    throw new InvalidArgumentException('Не указано местопольжение для получения данных о погоде');
}

if (!isset($argv[2])) {
    throw new InvalidArgumentException('Не указан формат для экспорта');
}

[$location, $format] = array_splice($argv, 1);

if (!in_array($format, ['json', 'xml'])) {
    throw new InvalidArgumentException('Неверно указан формат для экспорта. Возможные варианты: json|xml');
}

use weather\application\dataExport\dto\ExportDataDto;
use weather\application\weather\WeatherDataNormalizer;
use weather\domain\weather\WeatherService;
use weather\infrastructure\api\exceptions\ApiException;
use weather\infrastructure\dataExport\DataExportService;
use weather\infrastructure\weatherDataProvider\openWeather\OpenWeatherDataProvider;

require __DIR__ . '/../bootstrap.php';

$weatherDataProvider = OpenWeatherDataProvider::factory(
    getenv('OPENWEATHER_API_URL'),
    getenv('OPENWEATHER_API_APIKEY')
);

$weatherService = new WeatherService($weatherDataProvider);

try {
    $weatherData = $weatherService->getWeatherData($location);
} catch (ApiException $exception) {
    logToConsole('Произошла ошибка на стадии выполнения запроса к API: "' . $exception->getMessage() . '"');
}

$weatherData = (new WeatherDataNormalizer())->normalize($weatherData);

$resultFilePath = (new DataExportService())->export(
    new ExportDataDto(
        ['weather' => $weatherData],
        BASE_PATH . '/result_' . $location . '.' . $format,
        $format
    )
);

logToConsole("Результат успешно сохранён по пути `$resultFilePath`");
