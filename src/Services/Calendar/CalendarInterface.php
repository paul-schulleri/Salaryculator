<?php
namespace Schulleri\Salaryculator\Services\Calendar;

use Schulleri\Salaryculator\Services\IntervalGenerator;


/**
 * Interface CalendarInterface
 * @package Schulleri\Salaryculator\Services\Calendar
 */
interface CalendarInterface
{
    /**
     * Calendar constructor.
     * @param IntervalGenerator $interval
     */
    public function __construct(IntervalGenerator $interval);

    /**
     * @return array
     */
    public function getDates(): array;

    /**
     * @param $callBack
     * @return CalendarInterface
     */
    public function each($callBack): CalendarInterface;
}
