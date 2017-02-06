<?php
namespace Schulleri\Salaryculator\Services\Calendar;


use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class DateContainerTest
 * @package Schulleri\Salaryculator\Services\Calendar
 * @covers Schulleri\Salaryculator\Services\Calendar\DateContainer
 */
class DateContainerTest extends TestCase
{
    /**
     *
     */
    public function testDateContainerGeneratesSelf()
    {
        $container = $this->generateContainer();

        $this->assertInstanceOf(DateContainerInterface::class, $container);
    }

    /**
     *
     */
    public function testCanGetDate()
    {
        $container = $this->generateContainer();

        $this->assertInstanceOf(
            DateTimeInterface::class, $container->getDate()
        );
    }

    /**
     *
     */
    public function testCanGetBonusDate()
    {
        $container = $this->generateContainer();

        $this->assertInstanceOf(
            DateTimeInterface::class, $container->getBonusDate()
        );
    }

    /**
     *
     */
    public function testCanGetRegularDate()
    {
        $container = $this->generateContainer();

        $this->assertInstanceOf(
            DateTimeInterface::class, $container->getRegularDate()
        );
    }

    /**
     * @return DateContainerInterface
     */
    private function generateContainer(): DateContainerInterface
    {
        $date = new DateTimeImmutable('2016-11-04 08:03:00');
        $container = DateContainer::generate($date);
        $container->setBonusSalaryDate($date);
        $container->setRegularSalaryDate($date);

        return $container;
    }
}
