<?php

namespace App\BackendBundle\Controller;
use App\BackendBundle\Entity\Photo;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class CoreController extends Controller
{

    public function getForm(Request $request , AbstractType $type , $entity)
    {
        $form = $this->createForm($type,$entity);
        $form->handleRequest($request);
        return $form;
    }

    public function to($route,$params = [])
    {
        return parent::redirect(parent::generateUrl($route,$params));
    }

    public function flash($type,$message)
    {
        $this->get('session')->getFlashBag()->add($type,$message);
    }

    public function processForm($form , $entity)
    {
        if(method_exists($entity,'setCreatedAt') )
        {
            $entity->setCreatedAt(new \Datetime());
        }

        if($entity instanceof Photo)
        {
            $data = $form->getData();
            $photo = $data->getPhoto();
            if($photo)
            {
                $entity->setPhoto($this->get('file.upload')->save($photo,'uploads/lesson'));
            }
        }

        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->getDoctrine()->getManager();
    }
}