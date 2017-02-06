<?php
namespace Schulleri\Salaryculator\Services\Calendar;

use Schulleri\Salaryculator\Services\IntervalGenerator;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

/**
 * Class Calendar
 * @package Schulleri\Salaryculator\Services\Calendar
 * @covers Schulleri\Salaryculator\Services\Calendar\Calendar
 * @covers Schulleri\Salaryculator\Services\Calendar\CollectionIteratorBase
 */
class CalendarTest extends TestCase
{
    /**
     *
     */
    public function testAddInterval()
    {
        $interval = new IntervalGenerator(
            new DateTimeImmutable('2016-11-04 08:03:00'),
            new DateTimeImmutable('2017-02-04 08:03:00')
        );

        $calendar = new Calendar($interval);
        $dates = $calendar->getDates();
        $expectedKeys = ['201612', '201701', '201702'];

        $this->assertTrue(
            $this->arrayKeysExists($dates, $expectedKeys), 'Expected Keys missing.'
        );
    }

    /**
     *
     */
    public function testCanLoopTroughCollection()
    {
        $interval = new IntervalGenerator(
            new DateTimeImmutable('2016-11-04 08:03:00'),
            new DateTimeImmutable('2017-02-05 08:03:00')
        );

        $calendar = new Calendar($interval);
        $result = [];

        $calendar->each(function (DateContainerInterface $item) use (&$result) {
            $result[] = $item;
        });

        $this->assertCount(3, $result);
    }

    /**
     * @param array $array
     * @param $keys
     * @return bool
     */
    private function arrayKeysExists(array $array, $keys)
    {
        $count = 0;
        if (!is_array($keys)) {
            $keys = func_get_args();
            array_shift($keys);
        }

        foreach ($keys as $key) {
            if (array_key_exists($key, $array)) {
                $count++;
            }
        }

        return count($keys) === $count;
    }
}
