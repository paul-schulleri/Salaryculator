<?php
namespace Schulleri\Salaryculator\Services\Calendar;


use DateTimeImmutable;

/**
 * Interface DateContainerInterface
 * @package Schulleri\Salaryculator\Services\Calendar
 */
interface DateContainerInterface
{
    /**
     * @param DateTimeImmutable $date
     * @return DateContainerInterface
     */
    public static function generate(DateTimeImmutable $date): DateContainerInterface;

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable;

    /**
     * @return DateTimeImmutable
     */
    public function getBonusDate(): DateTimeImmutable;

    /**
     * @return DateTimeImmutable
     */
    public function getRegularDate(): DateTimeImmutable;

    /**
     * @param DateTimeImmutable $date
     */
    public function setBonusSalaryDate(DateTimeImmutable $date);

    /**
     * @param DateTimeImmutable $date
     */
    public function setRegularSalaryDate(DateTimeImmutable $date);
}
