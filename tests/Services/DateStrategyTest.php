<?php
namespace Schulleri\Salaryculator\Services;


use Schulleri\Salaryculator\Services\Calendar\DateContainer;
use Schulleri\Salaryculator\Rules\SalaryRule;
use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class DateStrategyTest
 * @package Schulleri\Salaryculator\Services
 * @covers Schulleri\Salaryculator\Services\DateStrategy
 */
class DateStrategyTest extends TestCase
{
    /**
     *
     */
    public function testStrategyReturnsInstanceOfDateTimeInterface()
    {
        $date = DateContainer::generate(new DateTimeImmutable());

        $strategy = new DateStrategy();
        $strategy->setRule(new SalaryRule());
        $processed = $strategy->process($date);

        $this->assertInstanceOf(DateTimeInterface::class, $processed);
    }
}
