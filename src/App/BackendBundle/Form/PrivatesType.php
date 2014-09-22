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
            ->add('photo' , 'file' , ['required'=>false , 'label'=>'头像信息'])
            ->add('city' , null , ['label'=>'所在的城市'])
            ->add('company' , null , ['label'=>'所在的公司'])
            ->add('phone' , null , ['label'=>'手机号'])
            ->add('job' , null , ['label'=>'职位'])
            ->add('interesting' , null , ['label'=>'对什么感兴趣'])
        ;

        $builder->add('submit','submit' , ['label'=>'更新']);
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
