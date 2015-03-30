<?php

namespace Acme\DemoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Hello World command for demo purposes.
 *
 * You could also extend from Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand
 * to get access to the container via $this->getContainer().
 *
 * @author Tobias Schultze <http://tobion.de>
 */
//class HelloWorldCommand extends Command
class HelloWorldCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('acme:hello')
            ->setDescription('Hello World example command')
            ->addArgument('who', InputArgument::OPTIONAL, 'Who to greet.', 'World')
            ->setHelp(<<<EOF
The <info>%command.name%</info> command greets somebody or everybody:

<info>php %command.full_name%</info>

The optional argument specifies who to greet:

<info>php %command.full_name%</info> Fabien
EOF
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('Hello <comment>%s</comment>!', $input->getArgument('who')));
        $output->writeln(sprintf('Hello <info>%s</info>!', $input->getArgument('who')));
        $output->writeln(sprintf('Hello <question>%s</question>!', $input->getArgument('who')));
        $output->writeln(sprintf('Hello <error>%s</error>!', $input->getArgument('who')));

        $progress = new ProgressBar($output, 10000);
        $progress->setFormat('%message% %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');

        $progress->setMessage('Task starts');
        $progress->start();

        $i = 0;
        while ($i++ < 10000) {
            $progress->setMessage('Task in progress...');
            $progress->advance();
        }

        $progress->setMessage('Finished!');
        $progress->finish();
    }
}
