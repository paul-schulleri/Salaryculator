<?php
namespace Schulleri\Salaryculator\Rules;

use DateTimeImmutable;

/**
 * Class RulesAbstract
 * @package Schulleri\Salaryculator\Services
 */
class RulesAbstract
{
    /**
     * @param DateTimeImmutable $date
     * @return bool
     */
    protected function isWeekend(DateTimeImmutable $date): bool
    {
        return ($date->format('w') === '6' || $date->format('w') === '0');
    }
}
