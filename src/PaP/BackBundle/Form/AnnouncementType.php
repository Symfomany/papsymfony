<?php

namespace PaP\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Class AnnouncementType
 * @package PaP\BackBundle\Form
 */
class AnnouncementType extends AbstractType implements FormTypeInterface
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('price')
            ->add('ref')
            ->add('address')
            ->add('city')
            ->add('cp')
            ->add('country')
            ->add('file', FileType::class, array('attr' => array('accept' => 'image/*')))
            ->add('type',ChoiceType::class, array(
                'choices'  => array('apt' => 'Appartment', 'hs' => 'House')
            ))
            ->add('energyLabel',ChoiceType::class, array(
                'choices'  => array('A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E', 'F' => 'F', 'G' => 'G',)
            ))
            ->add('surface')
            ->add('nbrooms')
            ->add('bedrooms')
            ->add('pricePerMeterSquare')
            ->add('content')
            ->add('activate')
            ->add('user',  EntityType::class,[
                'expanded'=>false,
                'class' => 'BackBundle:User',
                'choice_label' => 'lastname',

            ]);


    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PaP\BackBundle\Entity\Announcement'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'announcement_form';
    }
}
