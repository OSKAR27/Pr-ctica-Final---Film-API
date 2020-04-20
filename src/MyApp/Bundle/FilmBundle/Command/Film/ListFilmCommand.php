<?php

namespace MyApp\Bundle\FilmBundle\Command\Film;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Doctrine\ORM\Query;
use MyApp\Component\Film\Domain\Film;

class ListFilmCommand extends ContainerAwareCommand
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:list-film';

    protected function configure()
    {
        $this
            ->setName('app:list-film')
            ->setDescription('List Film..');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();

        $films = $em->getRepository('\MyApp\Component\Film\Domain\Film')->findAll(Query::HYDRATE_ARRAY);

        $filmsAsArray = array_map(function (Film $f) {
            return  [
                'id' => $f->getId(),
                'name' => $f->getName(),
                'description' => $f->getDescription(),
                'actor' => $f->getActor()->getName()
            ];
        }, $films);

       $output->writeln(var_dump($filmsAsArray));
    }
}