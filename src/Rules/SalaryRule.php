<?php
namespace Schulleri\Salaryculator\Rules;

use Schulleri\Salaryculator\Services\Calendar\DateContainerInterface;
use DateTimeImmutable;

/**
 * Class SalaryRule
 * Defines the rules for regular salary.
 *
 * @package Schulleri\Salaryculator\Services
 */
class SalaryRule extends RulesAbstract implements RuleInterface
{
    const LAST_DAY_OF_MONTH = 'last day of this month';
    const NEXT_WEDNESDAY = 'next wednesday';
    const PREVIOUS_WEEKDAY = 'last friday';

    /**
     * @param DateContainerInterface $date
     * @return DateTimeImmutable
     */
    public function execute(DateContainerInterface $date): DateTimeImmutable
    {
        $calculated = $this->calculateDate(
            $date->getDate()->modify(self::LAST_DAY_OF_MONTH)
        );

        $date->setRegularSalaryDate($calculated);

        return $calculated;
    }

    /**
     * @param $date
     * @return DateTimeImmutable
     */
    private function calculateDate(DateTimeImmutable $date): DateTimeImmutable
    {
        if ($this->isWeekend($date)) {
            return $date->modify(self::PREVIOUS_WEEKDAY);
        }

        return $date;
    }
}
