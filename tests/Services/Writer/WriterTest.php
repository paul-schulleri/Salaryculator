<?php
namespace Schulleri\Salaryculator\Services\Writer;

use Schulleri\Salaryculator\Core\Result\Result;
use Schulleri\Salaryculator\Services\Calendar\Calendar;
use Schulleri\Salaryculator\Services\Writer\Drivers\CsvDriver;
use PHPUnit\Framework\TestCase;

/**
 * Class WriterTest
 * @package Schulleri\Salaryculator\Services\Writer
 * @covers Schulleri\Salaryculator\Services\Writer\Writer
 */
class WriterTest extends TestCase
{
    /**
     *
     */
    public function testCanWriteUsingDriver()
    {
        $expected = '--success--';
        $driver = $this->getDriverMock($expected);

        $writer = new Writer($driver);
        $result = $writer->write($this->getCalendarMock(), '');

        $this->assertEquals($expected, $result->get());
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
     * @param string $message
     * @return CsvDriver
     */
    private function getDriverMock(string $message): CsvDriver
    {
        $driver = $this->getMockBuilder(CsvDriver::class)->getMock();
        $driver->method('store')->willReturn(Result::success($message));

        /** @var CsvDriver $driver */
        return $driver;
    }
}
