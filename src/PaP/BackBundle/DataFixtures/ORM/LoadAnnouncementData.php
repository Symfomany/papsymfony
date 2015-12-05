<?php
namespace PaP\BackBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PaP\BackBundle\Entity\Announcement;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadAnnouncementData
 * @package PaP\BackBundle\DataFixtures\ORM
 */
class LoadAnnouncementData extends AbstractFixture implements OrderedFixtureInterface, FixtureInterface
{



    public function load(ObjectManager $manager)
    {
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
            'user' => $this->getReference('user')
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
        $manager->persist($announcement);
        $manager->flush();

    }

    public function getOrder()
    {
        return 2;
    }

}













