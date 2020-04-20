<?php

namespace MyApp\Bundle\FilmBundle\Command\Actor;

use Symfony\Component\Console\Command\Command;
use MyApp\Component\Film\Domain\Actor;
use Symfony\Component\Console\Input\InputInterface;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Output\OutputInterface;

class ListActorCommand extends ContainerAwareCommand
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:list-actor';

    protected function configure()
    {
        $this
            ->setName('app:list-actor')
            ->setDescription('List Actor');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();

        $actors = $em->getRepository('\MyApp\Component\Film\Domain\Actor')->findAll(Query::HYDRATE_ARRAY);

        $actorsAsArray = array_map(function (Actor $o) {
            return [
                'id' => $o->getId(),
                'name' => $o->getName()
            ];
       }, $actors);

       $output->writeln(var_dump($actorsAsArray));

    }
}