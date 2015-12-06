<?php
namespace PaP\FrontBundle\Tests\Command;

use Doctrine\ODM\MongoDB\DocumentManager;
use PaP\BackBundle\Command\AnnouncementCommand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Test Announcement
 * Class AnnouncementCommandTest
 * @package PaP\FrontBundle\Tests\Command
 */
    class AnnouncementCommandTest extends KernelTestCase{

        /**
         * @var container
         */
        private $container;

        /**
         * setup for the container
         */
        public function setUp()
        {
            self::bootKernel();

            $this->container = self::$kernel->getContainer();
        }

        /**
         * Execute
         */
        public function testExecute()
        {
            $application = new Application();

            $application->add($this->container->get('announcement_command'));

            $command = $application->find('notifications:purge');
            $commandTester = new CommandTester($command);
            $commandTester->execute(array('command' => $command->getName()));
            $this->assertRegExp('/Terminé|affect/', $commandTester->getDisplay());

        }




}



























