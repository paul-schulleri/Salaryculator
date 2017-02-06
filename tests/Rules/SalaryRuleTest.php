<?php
namespace Schulleri\Salaryculator\Rules;

use Schulleri\Salaryculator\Services\Calendar\DateContainer;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

/**
 * Class BonusRuleTest
 * @package Schulleri\Salaryculator\Rules
 * @covers Schulleri\Salaryculator\Rules\SalaryRule
 * @covers Schulleri\Salaryculator\Rules\RulesAbstract
 */
class SalaryRuleTest extends TestCase
{
    /**
     *
     */
    public function testReturnsDateTimeImmutable()
    {
        $date = DateContainer::generate(new DateTimeImmutable('2016-11-04 08:03:00'));
        $rule = new SalaryRule();
        $calculated = $rule->execute($date);

        $this->assertInstanceOf(DateTimeImmutable::class, $calculated);
    }

    /**
     *
     */
    public function testCalculatesWeekDay()
    {
        $date = DateContainer::generate(new DateTimeImmutable('2016-11-04 08:03:00'));
        $rule = new SalaryRule();
        $calculated = $rule->execute($date);

        $this->assertEquals('20161130', $calculated->format('Ymd'));
    }
    /**
     *
     */
    public function testCalculatesWeekend()
    {
        $date = DateContainer::generate(new DateTimeImmutable('2016-7-04 08:03:00'));
        $rule = new SalaryRule();
        $calculated = $rule->execute($date);

        $this->assertEquals('20160729', $calculated->format('Ymd'));
    }
}
