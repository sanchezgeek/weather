<?php

namespace weather\application\weather\provider\dto;

/**
 * DTO для передачи данных о погоде
 */
class ReceivedWeatherAttributes
{
    /** @var float Температура воздуха */
    protected $temp;

    /** @var int Скорость ветра */
    protected $windSpeed;

    /** @var int Направление ветра */
    protected $windDeg;

    /**
     * WeatherData constructor.
     *
     * @param float $temp
     */
    public function __construct(float $temp, int $windSpeed, int $windDeg)
    {
        $this->temp = $temp;
        $this->windSpeed = $windSpeed;
        $this->windDeg = $windDeg;
    }

    /**
     * @return float
     */
    public function getTemp(): float
    {
        return $this->temp;
    }

    /**
     * @return int
     */
    public function getWindSpeed(): int
    {
        return $this->windSpeed;
    }

    /**
     * @return int
     */
    public function getWindDeg(): int
    {
        return $this->windDeg;
    }
}
