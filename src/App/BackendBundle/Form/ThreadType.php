<?php

namespace App\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ThreadType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject' , null , ['label' => '帖子标题'])
            ->add('content' , null , ['label' => '帖子内容'])
        ;

        $builder->add('submit','submit' , ['label'=>'发布']);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\BackendBundle\Entity\Thread'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'thread';
    }
}
