<?php
namespace PaP\FrontBundle\Tests\Form;

use PaP\BackBundle\Entity\Announcement;
use PaP\BackBundle\Form\AnnouncementType;
use Symfony\Bridge\Doctrine\Form\DoctrineOrmExtension;
use Symfony\Bridge\Doctrine\Test\DoctrineTestHelper;
use Symfony\Component\Form\Extension\Validator\Type\FormTypeValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Tests\Extension\Core\Type;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Test Form
 * Class AnnouncementTypeTest
 * @package PaP\FrontBundle\Tests\Form
 */
class AnnouncementTypeTest extends TypeTestCase
{

    /**
     * @var
     */
    protected $em;

    /**
     * @var
     */
    protected $emRegistry;


    /**
     * @var
     */
    protected $builder;


    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
//        $this->em = DoctrineTestHelper::createTestEntityManager();
//        $this->emRegistry = $this->createRegistryMock('default', $this->em);

        parent::setUp();

    }



    public function testSubmitValidData()
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

        $form = new AnnouncementType();

        $form = $this->factory->create($form);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($announcement, $form->getData());
//        $view = $form->createView();
//        $children = $view->children;

    }


    public function getExtensions(){
        return array_merge(parent::getExtensions(), array(
//            new DoctrineOrmExtension($this->emRegistry),
        ));

    }

    protected function createRegistryMock($name, $em)
    {
        $registry = $this->getMock('Doctrine\Common\Persistence\ManagerRegistry');
        $registry->expects($this->any())
            ->method('getManager')
            ->with($this->equalTo($name))
            ->will($this->returnValue($em));

        $registry->expects($this->any())
            ->method('getManagerForClass')
            ->will($this->returnValue($em));

        return $registry;
    }
}





