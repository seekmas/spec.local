<?php

namespace App\FrontendBundle\Controller;

use App\BackendBundle\Controller\CoreController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FirstController extends CoreController
{
    /**
     * @Route("/" , name="home_page")
     * @Template()
     */
    public function indexAction()
    {

        $lessons = $this->get('lesson.entity')->findAll();


        return [
            'lessons' => $lessons ,
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

}