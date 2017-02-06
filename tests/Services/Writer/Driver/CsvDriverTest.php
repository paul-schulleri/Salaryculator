<?php
namespace Schulleri\Salaryculator\Services\Writer\Drivers;

use Schulleri\Salaryculator\Services\Calendar\Calendar;
use PHPUnit\Framework\TestCase;

/**
 * Class CsvDriverTest
 * @package Schulleri\Salaryculator\Services\Writer\Drivers
 * @covers Schulleri\Salaryculator\Services\Writer\Drivers\CsvDriver
 */
class CsvDriverTest extends TestCase
{
    /**
     *
     */
    public function testCanStore()
    {
        $outputName = '_unitTest' . time();
        $fullPath = CsvDriver::STORAGE_DIR . $outputName . '.csv';
        $this->deleteFile($fullPath);
        $driver = new CsvDriver();

        $driver->store($this->getCalendarMock(), $outputName);

        $this->assertFileExists($fullPath);
        $this->deleteFile($fullPath);
    }

    /**
     * @return Calendar
     */
    public function getCalendarMock(): Calendar
    {
        $mock = $this->getMockBuilder(Calendar::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var Calendar $mock */
        return $mock;
    }

    /**
     * @param $fullPath
     */
    private function deleteFile($fullPath)
    {
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}
