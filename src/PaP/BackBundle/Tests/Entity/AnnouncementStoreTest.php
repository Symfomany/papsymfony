<?php
namespace PaP\FrontBundle\Tests\Command;

use PaP\BackBundle\Entity\Announcement;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Test Announcement
 * Class AnnouncementCommandTest
 * @package PaP\FrontBundle\Tests\Command
 */
    class AnnouncementStoreTest extends KernelTestCase{

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



        public function getDatas()
        {
            return array(
                array("Annonce A"),
                array("Annonce B"),
                array("Annonce C"),
                array("Annonce D"),
                array("Annonce E"),
            );
        }

        /**
         * The application contains a lot of secure URLs which shouldn't be
         * publicly accessible. This tests ensures that whenever a user tries to
         * access one of those pages, a redirection to the login form is performed.
         *
         * @dataProvider getDatas
         */
        public function testCreate($datas)
        {
            $em = $this->container->get('doctrine.orm.entity_manager');
            $user = $em->getRepository("BackBundle:User")->findOneByPseudo("djscrave");

            $formData = array(
                'title' => $datas,
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
            $this->assertEquals($datas, $announcement->getTitle());

            $announcement = $em->getRepository("BackBundle:Announcement")->findOneByTitle($datas);
            $announcement->setTitle("New B");
            $em->persist($announcement);
            $em->flush();

            $this->assertEquals("New B", $announcement->getTitle());
            $em->remove($announcement);
            $em->flush();
            $announcement = $em->getRepository("BackBundle:Announcement")->findOneByTitle("New B");

            $this->assertEquals(null, $announcement);
        }




}



























