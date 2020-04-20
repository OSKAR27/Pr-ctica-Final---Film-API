<?php

namespace MyApp\Bundle\FilmBundle\Command\Actor;

use MyApp\Component\Film\Application\UseCase\Actor\NewActorUseCase;
use Symfony\Component\Console\Command\Command;
// Add the Container
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use MyApp\Component\Film\Domain\Actor;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class CreateActorCommand extends ContainerAwareCommand
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-actor';
    private $newActorUseCase;

    public function __construct($name = null)
    {
        parent::__construct($name);
        
    }

    protected function configure()
    {
        $this
            ->setName('app:create-actor')
            ->setDescription('Create a Actor...')
            ->addArgument(
                "name"
                , InputArgument::REQUIRED
                , "The actor name");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument("name");
        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();

        $actor = new Actor($name);
        $em->persist($actor);
        $em->flush();
        $output->writeln("Register.");
    }
}
