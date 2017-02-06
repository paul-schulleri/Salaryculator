<?php
namespace Schulleri\Salaryculator\Core;

use Schulleri\Salaryculator\Core\Result\Result;
use Schulleri\Salaryculator\Services\Calendar\Calendar;
use Schulleri\Salaryculator\Services\Calendar\CalendarInterface;
use Schulleri\Salaryculator\Services\IntervalGenerator;
use Schulleri\Salaryculator\Services\Writer\Drivers\CsvDriver;
use Schulleri\Salaryculator\Services\Writer\Drivers\DriverInterface;
use Schulleri\Salaryculator\Services\Writer\Writer;
use Schulleri\Salaryculator\Services\Writer\WriterInterface;
use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\Input;

/**
 * Class BootstrapTest
 * @package Schulleri\Salaryculator\Core
 * @covers Schulleri\Salaryculator\Core\Bootstrap
 */
class BootstrapTest extends TestCase
{
    /**
     *
     */
    public function testCanBootstrap()
    {
        $container = new Container();
        $expected = '_unitTest' . time();
        $input = $this->getInputMock($expected);
        $executed = (new Bootstrap($container))->boot()->process($input);
        $this->assertStringEndsWith($expected . '.csv', $executed->getResult()->get());
        $this->deleteFile($this->fullPath($expected));
    }

    /**
     *
     */
    public function testBindsDriver()
    {
        $container = $this->prepareContainer();

        $this->assertInstanceOf(
            CsvDriver::class, $container->make(DriverInterface::class)
        );
    }

    /**
     *
     */
    public function testBindsCalendar()
    {
        $container = $this->prepareContainer();

        $this->assertInstanceOf(
            Calendar::class, $container->make(CalendarInterface::class)
        );
    }

    /**
     *
     */
    public function testBindsWriter()
    {
        $container = $this->prepareContainer();

        $this->assertInstanceOf(
            Writer::class, $container->make(WriterInterface::class)
        );
    }

    /**
     *
     */
    public function testBindsIntervalGenerator()
    {
        $container = $this->prepareContainer();

        $this->assertInstanceOf(
            IntervalGenerator::class, $container->make(IntervalGenerator::class)
        );
    }

    /**
     * @param $expected
     * @return Input
     */
    private function getInputMock($expected): Input
    {
        $input = $this->getMockBuilder(Input::class)->getMock();
        $input->method('getOption')->willReturn($expected);
        /** @var Input $input */
        return $input;
    }

    /**
     * @return Container
     */
    private function prepareContainer(): Container
    {
        $container = new Container();
        $expected = '_unitTest' . time();
        $input = $this->getInputMock($expected);
        $container->bind(DriverInterface::class, $this->getDriverMock($expected));
        (new Bootstrap($container))->boot($input);

        return $container;
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

    /**
     * @param $fullPath
     */
    private function deleteFile($fullPath)
    {
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    /**
     * @param $outputName
     * @return string
     */
    private function fullPath($outputName)
    {
        return CsvDriver::STORAGE_DIR . $outputName . '.csv';
    }
}
