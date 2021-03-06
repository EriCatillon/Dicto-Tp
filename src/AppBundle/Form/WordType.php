<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class WordType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('theWord')
            ->add('mail', 'email')
            ->add('definition')
            ->add('pronunciation')
            ->add('example')
            ->add('origin')
            ->add('useOfWord')
            //->add('vote')
            ->add('categorie', 'choice', array(
                'choices'   => array(
                    'vocabulaire' => 'Vocabulaire',
                    'sacres' => 'Sacres',
                    'deformations' => 'Déformations',
                ),
                'multiple'  => false,
            ))
            ->add('captcha', 'captcha')
            ->add('Go','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Word'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_word';
    }
}
