<?php
namespace Schulleri\Salaryculator\Services;

use DateTimeImmutable;

/**
 * Class IntervalGenerator
 * Class for generations an interval from given start to end date.
 * By default returns 12 months if no end date set.
 *
 * @package Schulleri\Salaryculator\Services
 */
class IntervalGenerator
{
    const DEFAULT_ADDITIONAL_MONTHS = 11;

    /** @var DateTimeImmutable */
    private $startDate;

    /** @var DateTimeImmutable */
    private $endDate;

    /**
     * IntervalGenerator constructor.
     * @param DateTimeImmutable $startDate
     * @param DateTimeImmutable $endDate
     */
    public function __construct(
        DateTimeImmutable $startDate = null,
        DateTimeImmutable $endDate = null
    ) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return array
     */
    public function generate(): array
    {
        $startDate = $this->startDate->modify('next month');
        $endDate = $this->endDate;

        if (!$endDate) {
            $endDate = $startDate->modify(self::DEFAULT_ADDITIONAL_MONTHS . '  month');
        }

        $differenceRange = range(
            0, $this->getMonthsDifference($this->startDate, $endDate)
        );

        return array_map(function (int $iterator) use ($startDate) {
            return $startDate->modify('+' . $iterator . ' month');
        }, $differenceRange);
    }

    /**
     * @param $startDate
     * @param $endDate
     * @return int
     */
    public function getMonthsDifference(
        DateTimeImmutable $startDate,
        DateTimeImmutable $endDate
    ): int {
        $interval = $startDate->diff($endDate);

        return ((($interval->y * 12) + $interval->m) ?: $interval->m) - 1;
    }
}
