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
            ->add('content' , null , ['label' => 'forum.reply'])
            ->add('photo' , 'file' , ['required'=>false,'label'=>'forum.upload'])
        ;
        $builder->add('submit' , 'submit' , ['label'=>'forum.reply_it']);
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
