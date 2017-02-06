<?php
namespace Schulleri\Salaryculator\Rules;

use Schulleri\Salaryculator\Services\Calendar\DateContainerInterface;
use DateTimeImmutable;

/**
 * Class BonusRule
 * Defines the rules for bonus salary.
 *
 * @package Schulleri\Salaryculator\Services
 */
class BonusRule extends RulesAbstract implements RuleInterface
{
    const FIRST_DAY_OF_MONTH = 'first day of this month';
    const MIDDLE_OF_MONTH = '+14 days';
    const NEXT_WEDNESDAY = 'next wednesday';

    /**
     * @param DateContainerInterface $date
     * @return DateTimeImmutable
     */
    public function execute(DateContainerInterface $date): DateTimeImmutable
    {
        $calculated = $this->calculateDate(
            $date->getDate()->modify(
                self::FIRST_DAY_OF_MONTH
            )->modify(
                self::MIDDLE_OF_MONTH
            )
        );

        $date->setBonusSalaryDate($calculated);

        return $calculated;
    }

    /**
     * @param $date
     * @return DateTimeImmutable
     */
    private function calculateDate(DateTimeImmutable $date): DateTimeImmutable
    {
        if ($this->isWeekend($date)) {
            return $date->modify(self::NEXT_WEDNESDAY);
        }

        return $date;
    }
}
