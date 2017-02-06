<?php
namespace Schulleri\Salaryculator\Services;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

/**
 * Class IntervalGeneratorTest
 * @package Schulleri\Salaryculator\Services
 * @covers Schulleri\Salaryculator\Services\IntervalGenerator
 */
class IntervalGeneratorTest extends TestCase
{
    /**
     *
     */
    public function testGeneratorFromStartEndDate()
    {
        $period = (new IntervalGenerator(
            new DateTimeImmutable('2016-11-04 08:03:00'),
            new DateTimeImmutable('2017-03-04 08:03:00')
        ))->generate();

        $expected = [
            '2016:12:04',
            '2017:01:04',
            '2017:02:04',
            '2017:03:04',
        ];

        $this->assertEquals($expected, [
            $period[0]->format('Y:m:d'),
            $period[1]->format('Y:m:d'),
            $period[2]->format('Y:m:d'),
            $period[3]->format('Y:m:d'),
        ]);
    }

    /**
     *
     */
    public function testAdditionalMonths()
    {
        $startDate = new DateTimeImmutable('2016-11-04 08:03:00');
        $period = (new IntervalGenerator($startDate))->generate();

        $this->assertCount(
            IntervalGenerator::DEFAULT_ADDITIONAL_MONTHS + 1, $period
        );
    }
}
