<?php

namespace App\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RequirementType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('requirement' , null , ['label'=>'type.requirement'])
            ->add('email' , null , ['label'=>'type.email'])
        ;

        $builder->add('submit','submit',['label'=>'type.send']);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\BackendBundle\Entity\Requirement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'requirement';
    }
}
