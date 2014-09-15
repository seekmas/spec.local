<?php

namespace App\BackendBundle\Controller;

use App\BackendBundle\Entity\Chapter;
use App\BackendBundle\Entity\Lesson;
use App\BackendBundle\Form\ChapterType;
use App\BackendBundle\Form\LessonType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FirstController extends CoreController
{
    /**
     * @Route("/" , name="lesson")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $lesson = new Lesson();
        $type = new LessonType();
        $form = $this->getForm($request,$type,$lesson);

        if( $form->isValid())
        {
            $this->processForm($form , $lesson);
            $this->flash('success' , 'add success');
            return $this->to('lesson');
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/chapter" , name="chapter")
     * @Template()
     */
    public function chapterAction(Request $request)
    {

        $chapter = new Chapter();
        $type = new ChapterType();
        $form = $this->getForm($request,$type,$chapter);
        if($form->isValid())
        {
            $this->processForm($form,$chapter);
            $this->flash('success' , '章节添加成功');
            return $this->to('chapter');
        }

        return ['form'=>$form->createView()];
    }

    public function emailAction()
    {
        return new Response(
            $this->get('mail.notify')->notify('notify service test' , 'This is a message from App\BackendBundle\Mailer\Mailer') ? '发送成功' : '发送失败'
        );
    }

}
