<?php
namespace Schulleri\Salaryculator\Services\Writer;

use Schulleri\Salaryculator\Core\Result\Result;
use Schulleri\Salaryculator\Services\Calendar\CalendarInterface;

/**
 * Interface DriverInterface
 * @package Schulleri\Salaryculator\Services\Driver
 */
interface WriterInterface
{
    /**
     * @param CalendarInterface $data
     * @param string $outputName
     * @return Result
     */
    public function write(CalendarInterface $data, string $outputName): Result;
}
