<?php
namespace Schulleri\Salaryculator\Services\Writer\Drivers;

use Schulleri\Salaryculator\Core\Result\Result;
use Schulleri\Salaryculator\Services\Calendar\CalendarInterface;

/**
 * Interface DriverInterface
 */
interface DriverInterface
{
    /**
     * @param CalendarInterface $calendar
     * @param string $outputName
     * @return Result
     */
    public function store(CalendarInterface $calendar, string $outputName): Result;
}
