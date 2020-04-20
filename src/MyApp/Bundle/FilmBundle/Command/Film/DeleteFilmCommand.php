<?php

namespace MyApp\Bundle\FilmBundle\Command\Film;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use MyApp\Component\Film\Domain\Film;

class DeleteFilmCommand extends ContainerAwareCommand
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:delete-film';

    protected function configure()
    {
        $this
            ->setName('app:delete-film')
            ->setDescription('Delete film...')
            ->addArgument(
                "id"
                , InputArgument::REQUIRED
                , "The film id");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filmId = $input->getArgument("id");

        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();
        $film = $em->getReference('\MyApp\Component\Film\Domain\Film',$filmId);

        $em->remove($film);
        $em->flush();
        $output->writeln("Deleted.");
    }
}