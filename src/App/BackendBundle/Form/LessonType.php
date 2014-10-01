<?php

namespace App\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LessonType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name' , null , ['label' => '课程名'])
            ->add('price' , null , ['label' => '价格'])
            ->add('free' , null , ['label' => '是否免费课程 (勾选则不用购买)'])
            ->add('category' , null , ['label' => '课程类别'])
            ->add('description' , null , ['label' => '课程描述'])
            ->add('photo' , 'file' , ['required' => false , 'label' => '课程封面'])
        ;

        $builder->add('submit' , 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\BackendBundle\Entity\Lesson'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lesson';
    }
}
