<?php

namespace App\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReplyType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content' , null , ['label' => '回复内容'])
            ->add('photo' , 'file' , ['required'=>false,'label'=>'图片'])
        ;
        $builder->add('submit' , 'submit' , ['label'=>'回复']);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\BackendBundle\Entity\Reply'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'reply';
    }
}
