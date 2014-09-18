<?php

namespace App\FrontendBundle\Controller;

use App\BackendBundle\Controller\CoreController;
use App\BackendBundle\Entity\Requirement;
use App\BackendBundle\Form\RequirementType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class FirstController extends CoreController
{
    /**
     * @Route("/" , name="home_page")
     * @Template()
     */
    public function indexAction()
    {

        $lessons = $this->get('lesson.entity')->findAll();

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

        return [
            'lesson' => $lesson ,
            'chapter'=> $chapter ,
        ];
    }

    /**
     * @Route("/requirements" , name="take_requirements")
     * @Template()
     */
    public function requirementAction(Request $request)
    {
        $user = $this->getUser();
        $requirement = new Requirement();
        $requirement->setUser($user);

        $type = new RequirementType();

        $form = $this->getForm($request,$type,$requirement);
        if($form->isValid())
        {
            $this->processForm($form,$requirement);
            $this->flash('success' , '谢谢你的反馈 你将有机会参与到新课程的免费学习');
            return $this->to('take_requirements');
        }

        return ['form'=>$form->createView()];
    }
}