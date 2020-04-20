<?php

namespace MyApp\Bundle\FilmBundle\Command\Film;

use Symfony\Component\Console\Command\Command;
use MyApp\Component\Film\Domain\Film;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;

class CreateFilmCommand extends ContainerAwareCommand
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-film';

    protected function configure()
    {
        $this
            ->setName('app:create-film')
            ->setDescription('Create Film')
            ->addArgument(
                "name"
                , InputArgument::REQUIRED
                , "The film name")
            ->addArgument(
              "description",
                InputArgument::REQUIRED,
                "The film description"
            )->addArgument(
                "actorId",
                InputArgument::REQUIRED,
                "The Actor id"
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument("name");
        $description = $input->getArgument("description");
        $actorId = $input->getArgument("actorId");

        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();

        $actor = $em->getRepository('\MyApp\Component\Film\Domain\Actor')->findOneBy(['id' => $actorId]);

        $film = new Film($name,$description, $actor);
        
        $em->persist($film);
        $em->flush();
        $output->writeln("Register.");
    }
}
