<?php
namespace Schulleri\Salaryculator\Commands;

use Schulleri\Salaryculator\Core\Bootstrap;
use Schulleri\Salaryculator\Core\Result\Result;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Write - Handles the write command.
 *
 * @package Schulleri\Salaryculator\Commands
 */
class WriteCommand extends Command
{
    const OPTION_FILENAME = 'filename';

    /** @var Bootstrap */
    private $bootstrap;

    /**
     * WriteCommand constructor.
     * @param Bootstrap $bootstrap
     * @throws LogicException
     */
    public function __construct(Bootstrap $bootstrap)
    {
        $this->bootstrap = $bootstrap;

        parent::__construct();
    }

    /**
     * @throws InvalidArgumentException
     */
    protected function configure()
    {
        $this->setName('write')
            ->setDescription('Write to File')
            ->addOption(
                self::OPTION_FILENAME,
                null,
                InputOption::VALUE_REQUIRED,
                'Specify output filename'
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     * @throws InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getOption(self::OPTION_FILENAME)) {
            throw new InvalidArgumentException('Required filename flag missing');
        }

        $output->writeln('Generating...');

        $app = $this->bootstrap->boot()->process($input);

        $output->writeln($this->getMessageFromResult($app->getResult()));

        return 1;
    }

    /**
     * @param Result $result
     * @return string
     */
    public function getMessageFromResult(Result $result): string
    {
        if ($result->isSuccess()) {
            return 'Successful saved to storage as: ' . $result->get();
        }

        return 'Ops, could not save file';
    }
}
