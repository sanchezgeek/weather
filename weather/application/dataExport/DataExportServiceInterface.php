<?php

namespace weather\application\dataExport;

use weather\application\dataExport\dto\ExportDataDto;

/**
 * Интерфейс сервиса экспорта данных
 */
interface DataExportServiceInterface
{
    /** Возможные форматы экспорта */
    public const TYPE_JSON = 'json';
    public const TYPE_XML = 'xml';

    /**
     * @param ExportDataDto $dataDto
     *
     * @return string Путь до файла экспорта
     */
    public function export(ExportDataDto $dataDto): string;
}
