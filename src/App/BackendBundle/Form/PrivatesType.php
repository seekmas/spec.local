<?php

namespace App\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PrivatesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('photo' , 'file' , ['required'=>false , 'label'=>'user.avatar'])
            ->add('city' , null , ['label'=>'user.city'])
            ->add('company' , null , ['label'=>'user.company'])
            ->add('phone' , null , ['label'=>'user.mobile'])
            ->add('job' , null , ['label'=>'user.job'])
            ->add('interesting' , null , ['label'=>'user.interested'])
        ;

        $builder->add('submit','submit' , ['label'=>'user.updated']);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\BackendBundle\Entity\Privates'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_backendbundle_privates';
    }
}
