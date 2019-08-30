<?php

namespace weather\application\dataExport\dto;

use weather\application\dataExport\DataExportServiceInterface;

/**
 * DTO для выполнения экспорта данных
 */
class ExportDataDto
{
    /** @var array Данные для экспорта */
    protected $data;

    /** @var string Путь до файла экспорта */
    protected $path;

    /** @var string Формат для экспорта */
    protected $format;

    /**
     * DataExportDto constructor.
     * @param array $data
     * @param string $path
     */
    public function __construct(array $data, string $path, string $format)
    {
        if (!in_array($format, [
            DataExportServiceInterface::TYPE_JSON,
            DataExportServiceInterface::TYPE_XML,
        ], true)) {
            throw new \InvalidArgumentException('Неверно указан формат для экспорта');
        }

        $this->data = $data;
        $this->path = $path;
        $this->format = $format;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }
}
