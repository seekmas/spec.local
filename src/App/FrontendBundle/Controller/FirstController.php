<?php

namespace App\FrontendBundle\Controller;

use App\BackendBundle\Controller\CoreController;
use App\BackendBundle\Entity\Requirement;
use App\BackendBundle\Form\RequirementType;
use App\BackendBundle\PurchaseStatus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class FirstController extends CoreController
{
    /**
     * @Route("/{categoryId}" , name="home_page" , requirements={"categoryId"="\d+"})
     * @Template()
     */
    public function indexAction($categoryId = 0)
    {

        if($categoryId == 0)
        {
            $lessons = $this->get('lesson.entity')->findAll();
        }
        else{
            $lessons = $this->get('lesson.entity')->findBy(['categoryId'=>$categoryId]);
        }

        $categories = $this->get('category.entity')->findAll();

        return [
            'lessons' => $lessons ,
            'categories' => $categories ,
        ];
    }

    /**
     * @Route("/{id}/lesson/{chapterId}",name="home_lesson" , requirements={"id" = "\d+" , "chapterId"="\d+"} , defaults={"chapterId" = 0})
     * @Template()
     */
    public function lessonAction($id = 0 , $chapterId = 0)
    {
        $lesson = $this->get('lesson.entity')->find($id);

        if( $chapterId > 0)
        {
            $chapter = $this->get('chapter.entity')->find($chapterId);
        }else
        {
            $chapter = null;
        }
        $user = $this->getUser();

        $purchase = $this->get('purchase.entity')->findOneBy([
            'lessonId' => $lesson->getId() ,
            'userId'   => $user->getId() ,
            'isLocked' => false ,
            'statusId' => PurchaseStatus::Paid ,
        ]);

        return [
            'lesson' => $lesson ,
            'chapter'=> $chapter ,
            'purchase' => $purchase ,
        ];
    }

    /**
     * @Route("/requirements" , name="take_requirements")
     * @Template()
     */
    public function requirementAction(Request $request)
    {

        $translator = $this->get('translator');

        $user = $this->getUser();
        $requirement = new Requirement();
        $requirement->setUser($user);

        $type = new RequirementType();

        $form = $this->getForm($request,$type,$requirement);
        if($form->isValid())
        {
            $this->processForm($form,$requirement);
            $this->flash('success' , $translator->trans('message.thanks_for_reply'));
            return $this->to('take_requirements');
        }

        return ['form'=>$form->createView()];
    }
}