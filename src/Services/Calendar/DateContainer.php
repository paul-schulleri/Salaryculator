<?php
namespace Schulleri\Salaryculator\Services\Calendar;


use DateTimeImmutable;

/**
 * Class DateContainer
 * Representing one single interval date.
 *
 * @package Schulleri\Salaryculator\Services\Calendar
 */
class DateContainer implements DateContainerInterface
{
    /** @var DateTimeImmutable */
    private $date;

    /** @var DateTimeImmutable */
    private $bonusDate;

    /** @var DateTimeImmutable */
    private $regularDate;

    /**
     * Date constructor.
     * @param DateTimeImmutable $date
     */
    private function __construct(DateTimeImmutable $date)
    {
        $this->date = $date;
    }

    /**
     * @param DateTimeImmutable $date
     * @return DateContainerInterface
     */
    public static function generate(DateTimeImmutable $date): DateContainerInterface
    {
        return new self($date);
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getBonusDate(): DateTimeImmutable
    {
        return $this->bonusDate;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getRegularDate(): DateTimeImmutable
    {
        return $this->regularDate;
    }

    /**
     * @param DateTimeImmutable $date
     */
    public function setBonusSalaryDate(DateTimeImmutable $date)
    {
        $this->bonusDate = $date;
    }

    /**
     * @param DateTimeImmutable $date
     */
    public function setRegularSalaryDate(DateTimeImmutable $date)
    {
        $this->regularDate = $date;
    }
}
