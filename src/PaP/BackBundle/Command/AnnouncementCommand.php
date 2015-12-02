<?php
namespace PaP\BackBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnnouncementCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('notifications:purge')
            ->setDescription('Purge all old notifications');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dm = $this->getContainer()->get('doctrine_mongodb.odm.default_document_manager');
        $notifs = $dm
            ->getRepository('BackBundle:Notifications')
            ->removeOld('-1 week');

    }
}