<?php

namespace MyApp\Bundle\FilmBundle\Command\Actor;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use MyApp\Component\Film\Domain\Actor;

class DeleteActorCommand extends ContainerAwareCommand
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:delete-actor';

    protected function configure()
    {
        $this
            ->setName('app:delete-actor')
            ->setDescription('Delete Actor')
            ->addArgument(
                "id"
                , InputArgument::REQUIRED
                , "The actor id");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $actorId = $input->getArgument("id");

        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();
        $actor = $em->getReference('\MyApp\Component\Film\Domain\Actor',$actorId);

        $em->remove($actor);
        $em->flush();
        $output->writeln("Deleted.");
    }
}