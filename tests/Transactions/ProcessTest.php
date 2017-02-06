<?php
namespace Schulleri\Salaryculator\Transactions;

use Schulleri\Salaryculator\Core\Result\Result;
use Schulleri\Salaryculator\Services\Calendar\Calendar;
use Schulleri\Salaryculator\Rules\BonusRule;
use Schulleri\Salaryculator\Rules\SalaryRule;
use Schulleri\Salaryculator\Services\DateStrategy;
use Schulleri\Salaryculator\Services\IntervalGenerator;
use Schulleri\Salaryculator\Services\Writer\Drivers\CsvDriver;
use Schulleri\Salaryculator\Services\Writer\Writer;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

/**
 * Class ProcessTest
 * @package Schulleri\Salaryculator\Transactions
 * @covers Schulleri\Salaryculator\Transactions\Process
 */
class ProcessTest extends TestCase
{
    public function testDefault()
    {
        $interval = new IntervalGenerator(
            new DateTimeImmutable('2016-11-04 08:03:00'),
            new DateTimeImmutable('2017-01-04 08:03:00'));

        $transaction = new Process(
            new DateStrategy(),
            new BonusRule(),
            new SalaryRule(),
            new Writer($this->getDriverMock('')),
            new Calendar($interval)
        );

        $result = $transaction->setOutputName('2016-11-04')->process();

        $this->assertTrue($result->isSuccess());
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
