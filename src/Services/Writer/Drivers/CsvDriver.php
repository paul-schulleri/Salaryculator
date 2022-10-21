<?php
namespace Schulleri\Salaryculator\Services\Writer\Drivers;

use Schulleri\Salaryculator\Core\Result\Result;
use Schulleri\Salaryculator\Services\Calendar\CalendarInterface;
use Schulleri\Salaryculator\Services\Calendar\DateContainerInterface;

/**
 * Class CsvDriver
 * Class to manage Calendar Data insertion into a CSV
 *
 * @package Schulleri\Salaryculator\Services\Writer\Drivers
 */
class CsvDriver implements DriverInterface
{
    const STORAGE_DIR = __DIR__ . '/../../../../Storage/';
    const DATE_FORMAT_SALARY = 'Y/m/d D';
    const DATE_FORMAT_MONTH = 'Y/n (F)';

    /**
     * @param CalendarInterface $calendar
     * @param string $outputName
     * @return Result
     */
    public function store(CalendarInterface $calendar, string $outputName): Result
    {
        $output = $this->buildContent($calendar);
        $path = $this->buildPath($outputName);
        $result = $this->storeToFile($path, $output);

        if ($result) {
            return Result::success(pathinfo($path)['basename']);
        }

        return Result::failure($path);
    }

    /**
     * @param string $storage
     * @param array $output
     * @return bool
     */
    private function storeToFile(string $storage, array $output): bool
    {
        $file = fopen($storage, 'wb');

        foreach ($output as $line) {
            fputcsv($file, $line, ',');
        }

        return fclose($file);
    }

    /**
     * @param string $outputName
     * @return string
     */
    private function buildPath(string $outputName): string
    {
        return self::STORAGE_DIR . $outputName . '.csv';
    }

    /**
     * @param CalendarInterface $calendar
     * @return array
     */
    private function buildContent(CalendarInterface $calendar): array
    {
        $output[] = ['Month', 'Regular', 'Bonus'];

        $calendar->each(function (DateContainerInterface $dateContainer) use (&$output) {
            $output[] = [
                $dateContainer->getDate()->format(self::DATE_FORMAT_MONTH),
                $dateContainer->getRegularDate()->format(self::DATE_FORMAT_SALARY),
                $dateContainer->getBonusDate()->format(self::DATE_FORMAT_SALARY)
            ];
        });

        return $output;
    }
}
