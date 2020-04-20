<?php

namespace MyApp\Bundle\FilmBundle\Command\Actor;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use MyApp\Component\Film\Domain\Actor;

class UpdateActorCommand extends ContainerAwareCommand
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:update-actor';

    protected function configure()
    {
        $this
            ->setName('app:update-actor')
            ->setDescription('Update Actor')
            ->addArgument(
                "id"
                , InputArgument::REQUIRED
                , "The actor id")
            ->addArgument(
                "name"
                , InputArgument::REQUIRED
                , "The actor name");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $actorId = $input->getArgument("id");
        $name = $input->getArgument("name");
        
        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();
        $actor = $em->getRepository('\MyApp\Component\Film\Domain\Actor')->findOneBy(['id' => $actorId]);

        $actor->setName($name);
        $em->persist($actor);
        $em->flush();
        $output->writeln("Updated.");
    }
}