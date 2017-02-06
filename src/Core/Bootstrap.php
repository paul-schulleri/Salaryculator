<?php
namespace Schulleri\Salaryculator\Core;

use Schulleri\Salaryculator\Commands\WriteCommand;
use Schulleri\Salaryculator\Core\Result\Result;
use Schulleri\Salaryculator\Services\Calendar\Calendar;
use Schulleri\Salaryculator\Services\Calendar\CalendarInterface;
use Schulleri\Salaryculator\Services\IntervalGenerator;
use Schulleri\Salaryculator\Services\Writer\Drivers\CsvDriver;
use Schulleri\Salaryculator\Services\Writer\Drivers\DriverInterface;
use Schulleri\Salaryculator\Services\Writer\Writer;
use Schulleri\Salaryculator\Services\Writer\WriterInterface;
use Schulleri\Salaryculator\Transactions\Process;
use Illuminate\Contracts\Container\Container as ContainerInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use DateTimeImmutable;

/**
 * Class Bootstrap
 * Defines bindings for resolving dependencies on
 * runtime, using IoC Container
 *
 * @package Schulleri\Salaryculator\Transactions
 */
class Bootstrap
{
    /** @var ContainerInterface */
    private $container;

    /** @var Result */
    private $result;

    /**
     * Bootstrap constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return self
     */
    public function boot(): self
    {
        $startDate = new DateTimeImmutable();

        $this->container->bind(WriterInterface::class, Writer::class);
        $this->container->bind(DriverInterface::class, CsvDriver::class);
        $this->container->bind(CalendarInterface::class, Calendar::class);

        $interval = $this->container->make(
            IntervalGenerator::class, [$startDate, null]
        );
        $this->container->instance(IntervalGenerator::class, $interval);

        return $this;
    }

    /**
     * @param InputInterface $input
     * @return self
     * @throws InvalidArgumentException
     */
    public function process(InputInterface $input): self
    {
        $fileName = $input->getOption(WriteCommand::OPTION_FILENAME);
        $this->result = $this->container
            ->make(Process::class)
            ->setOutputName($fileName)->process();

        return $this;
    }

    /**
     * @return Result
     */
    public function getResult(): Result
    {
        return $this->result;
    }
}
