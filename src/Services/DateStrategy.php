<?php
namespace Schulleri\Salaryculator\Services;

use Schulleri\Salaryculator\Services\Calendar\DateContainerInterface;
use Schulleri\Salaryculator\Rules\RuleInterface;
use DateTimeImmutable;

/**
 * Class DateStrategy
 * Processing date by it's given strategy.
 *
 * @package Schulleri\Salaryculator\Services
 */
class DateStrategy
{
    /** @var RuleInterface */
    private $rule;

    /**
     * @param DateContainerInterface $date
     * @return DateTimeImmutable
     */
    public function process(DateContainerInterface $date): DateTimeImmutable
    {
        return $this->rule->execute($date);
    }

    /**
     * @param RuleInterface $rule
     * @return $this
     */
    public function setRule(RuleInterface $rule)
    {
        $this->rule = $rule;
        return $this;
    }
}
