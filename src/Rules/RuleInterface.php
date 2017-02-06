<?php
namespace Schulleri\Salaryculator\Rules;

use Schulleri\Salaryculator\Services\Calendar\DateContainerInterface;
use DateTimeImmutable;

/**
 * Interface RuleInterface
 * @package Schulleri\Salaryculator\Services
 */
interface RuleInterface
{
    /**
     * @param DateContainerInterface $date
     * @return DateTimeImmutable
     */
    public function execute(DateContainerInterface $date): DateTimeImmutable;
}
