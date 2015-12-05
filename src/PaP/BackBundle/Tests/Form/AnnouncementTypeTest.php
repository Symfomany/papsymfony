<?php
namespace PaP\FrontBundle\Tests\Form;

use PaP\BackBundle\Entity\Announcement;
use PaP\BackBundle\Form\AnnouncementType;
use Symfony\Bridge\Doctrine\Test\DoctrineTestHelper;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Tests\Extension\Core\Type;

/**
 * Test Form
 * Class AnnouncementTypeTest
 * @package PaP\FrontBundle\Tests\Form
 */
class AnnouncementTypeTest extends TypeTestCase
{

    /**
     * SUbmit this form and all attributes
     */
    public function testSubmitValidData()
    {
        $this->markTestSkipped( 'PHPUnit will skip this test method' );

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
        $announcement->setActivate($formData['activate']);
//        $announcement->setUser($formData['user']);

        $form = new AnnouncementType();

        $form = $this->factory->create($form);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($announcement, $form->getData());

        // Ensure the view has all required variables
        $view = $form->createView();
        $children = $view->children;
        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }

    }

}





