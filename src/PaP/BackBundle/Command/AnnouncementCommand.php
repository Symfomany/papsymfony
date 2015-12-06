<?php
namespace PaP\BackBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * Class AnnouncementCommand
 * @package PaP\BackBundle\Command
 */
class AnnouncementCommand extends Command
{

    /**
     * @var DocumentManager
     */
    protected $dm;

    /**
     * @param DocumentManager $dm
     */
    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
        parent::__construct();
    }

    /**
     * Configure
     */
    protected function configure()
    {
        $this
            ->setName('notifications:purge')
            ->setDescription('Purge all old notifications');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rows = $this->dm->getRepository('BackBundle:Notifications')
            ->removeOld('-1 week');

        $output->writeln("<info>{$rows['n']} affecté(s)</info>");
        $output->writeln('<info>Terminé!</info>');


    }
}