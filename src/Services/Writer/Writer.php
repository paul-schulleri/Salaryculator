<?php
namespace Schulleri\Salaryculator\Services\Writer;

use Schulleri\Salaryculator\Core\Result\Result;
use Schulleri\Salaryculator\Services\Calendar\CalendarInterface;
use Schulleri\Salaryculator\Services\Writer\Drivers\DriverInterface;

/**
 * Class Writer
 * Class responsible for writing to persistence.
 *
 * @package Schulleri\Salaryculator\Services\Writer
 */
class Writer implements WriterInterface
{
    /** @var DriverInterface */
    private $driver;

    /**
     * Driver constructor.
     * @param DriverInterface $driver
     */
    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @param CalendarInterface $data
     * @param string $outputName
     * @return Result
     */
    public function write(CalendarInterface $data, string $outputName): Result
    {
        return $this->driver->store($data, $outputName);
    }
}
