<?php
namespace Schulleri\Salaryculator\Transactions;

use Schulleri\Salaryculator\Core\Result\Result;
use Schulleri\Salaryculator\Services\Calendar\Calendar;
use Schulleri\Salaryculator\Services\Calendar\CalendarInterface;
use Schulleri\Salaryculator\Services\Calendar\DateContainerInterface;
use Schulleri\Salaryculator\Rules\BonusRule;
use Schulleri\Salaryculator\Services\DateStrategy;
use Schulleri\Salaryculator\Rules\SalaryRule;
use Schulleri\Salaryculator\Services\Writer\WriterInterface;

/**
 * Class Process
 * Main Class for processing incoming date
 * writing and returning Result
 *
 * @package Schulleri\Salaryculator\Services
 */
class Process
{
    /** @var SalaryRule */
    private $salaryRule;

    /** @var BonusRule */
    private $bonusRule;

    /** @var DateStrategy */
    private $dateStrategy;

    /** @var WriterInterface */
    private $writer;

    /** @var Calendar */
    private $calendar;

    /** @var string */
    private $outputName;

    /**
     * Process constructor.
     * @param DateStrategy $dateStrategy
     * @param BonusRule $bonusRule
     * @param SalaryRule $salaryRule
     * @param WriterInterface $writer
     * @param CalendarInterface $calendar
     */
    public function __construct(
        DateStrategy $dateStrategy,
        BonusRule $bonusRule,
        SalaryRule $salaryRule,
        WriterInterface $writer,
        CalendarInterface $calendar
    ) {
        $this->salaryRule = $salaryRule;
        $this->bonusRule = $bonusRule;
        $this->dateStrategy = $dateStrategy;
        $this->writer = $writer;
        $this->calendar = $calendar;
    }

    /**
     * @return Result
     */
    public function process(): Result
    {
        $this->calendar->each(function (DateContainerInterface $date) {
            $this->dateStrategy->setRule(
                $this->bonusRule
            )->process($date);
        });

        $this->calendar->each(function (DateContainerInterface $date) {
            $this->dateStrategy->setRule(
                $this->salaryRule
            )->process($date);
        });

        return $this->writer->write($this->calendar, $this->outputName);
    }

    /**
     * @param string $outputName
     * @return $this
     */
    public function setOutputName(string $outputName)
    {
        $this->outputName = $outputName;

        return $this;
    }
}
