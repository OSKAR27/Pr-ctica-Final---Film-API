<?php

namespace MyApp\Bundle\FilmBundle\Command\Film;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use MyApp\Component\Film\Domain\Film;

class UpdateFilmCommand extends ContainerAwareCommand
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:update-film';

    protected function configure()
    {
        $this
            ->setName('app:update-film')
            ->setDescription('Update Film...')
            ->addArgument(
                "id"
                , InputArgument::REQUIRED
                , "The Film id")
            ->addArgument(
                "name"
                , InputArgument::REQUIRED
                , "The film name")
            ->addArgument(
              "description",
                InputArgument::REQUIRED,
                "The film description"
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filmId = $input->getArgument("id");
        $name = $input->getArgument("name");
        $description = $input->getArgument("description");

        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();

        $film = $em->getRepository('\MyApp\Component\Film\Domain\Film')->findOneBy(['id' => $filmId]);
        $film->setName($name);
        $film->setDescription($description);
        $em->persist($film);
        $em->flush();
        
        $output->writeln("Updated.");
    }
}