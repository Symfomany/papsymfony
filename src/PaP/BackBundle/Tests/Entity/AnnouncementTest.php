<?php
namespace PaP\FrontBundle\Tests\Command;

use Doctrine\ODM\MongoDB\DocumentManager;
use PaP\BackBundle\Command\AnnouncementCommand;
use PaP\BackBundle\Entity\Announcement;
use PaP\BackBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Test Announcement
 * Class AnnouncementCommandTest
 * @package PaP\FrontBundle\Tests\Command
 */
    class AnnouncementTest extends KernelTestCase{

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
        public function testCreate()
        {
            //$this->markTestSkipped( 'PHPUnit will skip this test method' );

            $em = $this->container->get('doctrine.orm.entity_manager');
            $user = $em->getRepository("BackBundle:User")->findOneByPseudo("djscrave");

            $formData = array(
                'title' => 'New',
                'price' => 23.55,
                'ref' => "BB-5555-A",
                'city' => "Paris",
                'cp' => "75002",
                'address' => "12 rue Mandar",
                'country' => "France",
                'type' => "apt",
                'energyLabel' => "A",
                'surface' => 25,
                'nbrooms' => 2,
                'bedrooms' => 3,
                'pricePerMeterSquare' => 100,
                'content' => "Description de mon appartement",
                'activate' => true,
                'user' => $user
            );

            $announcement = new Announcement();
            $announcement->setTitle($formData['title']);
            $announcement->setPrice((float)$formData['price']);
            $announcement->setRef($formData['ref']);
            $announcement->setAddress($formData['address']);
            $announcement->setCity($formData['city']);
            $announcement->setCp($formData['cp']);
            $announcement->setContent($formData['content']);
            $announcement->setCountry($formData['country']);
            $announcement->setType($formData['type']);
            $announcement->setEnergyLabel($formData['energyLabel']);
            $announcement->setNbrooms((int)$formData['nbrooms']);
            $announcement->setBedrooms((int)$formData['bedrooms']);
            $announcement->setSurface($formData['surface']);
            $announcement->setPricePerMeterSquare((float)$formData['pricePerMeterSquare']);
            $announcement->setActivate($formData['activate']);
            $announcement->setUser($formData['user']);

            $em->persist($announcement);
            $em->flush();



        }




}



























