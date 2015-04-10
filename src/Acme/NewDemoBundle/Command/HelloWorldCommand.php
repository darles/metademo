<?php

namespace Acme\NewDemoBundle\Command;

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
class HelloWorldCommand extends \Acme\DemoBundle\Command\HelloWorldCommand
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
        $output->writeln(sprintf('Hello New <comment>%s</comment>!', $input->getArgument('who')));
        $output->writeln(sprintf('Hello New <info>%s</info>!', $input->getArgument('who')));
        $output->writeln(sprintf('Hello New <question>%s</question>!', $input->getArgument('who')));
        $output->writeln(sprintf('Hello New <error>%s</error>!', $input->getArgument('who')));
    }
}
