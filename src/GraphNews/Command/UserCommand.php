<?php
/**
 * 
 * @author: Jean-Philippe Dépigny <jdepigny.ext@orange.com>
 * Date: 12/08/2015
 * Time: 12:04
 */

namespace GraphNews\Command;



use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UserCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('user:encode-password')
            ->setDescription('encode a password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $dialog = $this->getHelperSet()->get('dialog');
        $password = $dialog->askHiddenResponse(
            $output,
            'Quel est le mot de passe à encoder ? ',
            false
        );

        $app = $this->getSilexApplication();
        $encodedPassword = $app['security.encoder.digest']->encodePassword($password, '');

        $output->writeln("Your password generated is => <fg=green>" .$encodedPassword) ."</fg=green>";
    }
}