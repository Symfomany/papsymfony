<?php
namespace PaP\BackBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PaP\BackBundle\Entity\User;

/**
 * Class LoadUserData
 * @package PaP\BackBundle\DataFixtures\ORM
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, FixtureInterface
{

    /**
     * load data
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $formData = array(
            'firstname' => 'Julien',
            'lastname' => 'Boyer',
            'email' => 'zuzu38080@gmail.com',
            'telephone' => '0674585648',
            'pseudo' => 'djscrave',
        );

        $user = new User();
        $user->setFirstname($formData['firstname']);
        $user->setLastname($formData['lastname']);
        $user->setEmail($formData['email']);
        $user->setTelephone($formData['telephone']);
        $user->setPseudo($formData['pseudo']);

        $manager->persist($user);
        $manager->flush();

        $this->addReference('user', $user);

    }

    /**
     * get Order
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }

}













