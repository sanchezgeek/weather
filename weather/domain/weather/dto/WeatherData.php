<?php

namespace weather\domain\weather\dto;

/**
 * DTO для представления данных о погодных условиях
 *
 * @package weather\application\weatherData\dto
 */
class WeatherData
{
    /** @var \DateTime Дата*/
    protected $onDate;

    /** @var string Название объекта */
    protected $location;

    /** @var float Температура воздуха */
    protected $temp;

    /** @var int Скорость ветра */
    protected $windSpeed;

    /** @var int Направление ветра */
    protected $windDeg;

    /**
     * WeatherData constructor.
     *
     * @param string $location
     * @param float $temp
     * @param int $windSpeed
     * @param int $windDeg
     */
    public function __construct(string $location, float $temp, int $windSpeed, int $windDeg)
    {
        $this->onDate = new \DateTime();
        $this->location = $location;
        $this->temp = $temp;
        $this->windSpeed = $windSpeed;
        $this->windDeg = $windDeg;
    }

    /**
     * @return \DateTime
     */
    public function getOnDate(): \DateTime
    {
        return $this->onDate;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
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
