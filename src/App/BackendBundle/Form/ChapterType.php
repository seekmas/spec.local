<?php

namespace App\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChapterType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('photo' , 'file' , ['required' => false ])
            ->add('shortDescription')
            ->add('longDescription')
            ->add('content')
            ->add('video')
            ->add('isFree')
            ->add('enabled')
            ->add('sortId')
            ->add('lesson')
        ;

        $builder->add('submit' , 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\BackendBundle\Entity\Chapter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'chapter';
    }
}
