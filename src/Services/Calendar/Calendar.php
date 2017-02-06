<?php
namespace Schulleri\Salaryculator\Services\Calendar;

use Schulleri\Salaryculator\Services\IntervalGenerator;
use DateTimeImmutable;

/**
 * Class Collection
 * Stores multiple Dates, gives
 * the possibility to easily iterate through.
 *
 * @package Schulleri\Salaryculator\Services\Collection
 */
class Calendar extends CollectionIteratorBase implements CalendarInterface
{
    const DATE_FORMAT = 'Ym';

    /**
     * Calendar constructor.
     * @param IntervalGenerator $interval
     */
    public function __construct(IntervalGenerator $interval)
    {
        foreach ($interval->generate() as $date) {
            $this->stackDate($date);
        }
    }

    /**
     * @return array
     */
    public function getDates(): array
    {
        return $this->collection;
    }

    /**
     * @param $callBack
     * @return CalendarInterface
     */
    public function each($callBack): CalendarInterface
    {
        foreach ($this->collection as $date) {
            $callBack($date);
        }

        return $this;
    }

    /**
     * @param $date
     */
    private function stackDate(DateTimeImmutable $date)
    {
        $key = $date->format(self::DATE_FORMAT);
        $this->collection[$key] = DateContainer::generate($date);
    }
}
