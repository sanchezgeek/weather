<?php

namespace weather\infrastructure\dataExport;

use SebastianBergmann\GlobalState\RuntimeException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

use weather\application\dataExport\DataExportServiceInterface;
use weather\application\dataExport\dto\ExportDataDto;

/**
 * Сервис экспорта данных
 */
class DataExportService implements DataExportServiceInterface
{
    /**
     * @inheritdoc
     */
    public function export(ExportDataDto $dataDto): string
    {
        $getMethodNormalizer = new GetSetMethodNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
        $serializer = new Serializer(
            [$getMethodNormalizer],
            [new XmlEncoder(), new JsonEncoder()]
        );

        if (!$path = realpath(dirname($dataDto->getPath()))) {
            throw new \InvalidArgumentException('Указанной для экспорта директории не существует');
        }

        $content = $serializer->serialize($dataDto->getData(), $dataDto->getFormat());

        if (!file_put_contents($dataDto->getPath(), $content)) {
            throw new RuntimeException("Не удалось сохранить файл по пути `{$dataDto->getPath()}`");
        }

        return realpath($dataDto->getPath());
    }
}
