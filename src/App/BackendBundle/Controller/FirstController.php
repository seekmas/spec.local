<?php

namespace App\BackendBundle\Controller;

use App\BackendBundle\Entity\Category;
use App\BackendBundle\Entity\Chapter;
use App\BackendBundle\Entity\Lesson;
use App\BackendBundle\Form\CategoryType;
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
     * @Route("/create_lesson/{id}" , name="create_lesson")
     * @Template()
     */
    public function lessonAction(Request $request , $id = null)
    {

        if( $id == null)
        {
            $lesson = new Lesson();
        }else
        {
            $lesson = $this->get('lesson.entity')->find($id);
        }

        $type = new LessonType();
        $tmpPhoto = $this->tmpPhotoHandle($lesson);

        $form = $this->getForm($request,$type,$lesson);

        if( $form->isValid())
        {
            $this->processForm($form , $lesson , $tmpPhoto);
            $this->flash('success' , 'add success');
            return $this->to('create_lesson');
        }

        $this->resetEntity($lesson , $tmpPhoto);

        $lessons = $this->get('lesson.entity')->findAll();

        return ['form' => $form->createView() , 'lessons' => $lessons];
    }

    /**
     * @Route("/create_chapter/{lessonId}/{chapterId}" , name="create_chapter")
     * @Template()
     */
    public function chapterAction(Request $request , $lessonId = null , $chapterId = null)
    {

        if( $chapterId == null)
        {
            $chapter = new Chapter();
        }
        else
        {
            $chapter = $this->get('chapter.entity')->find($chapterId);
        }

        if( $lessonId != null)
        {
            $lesson = $this->get('lesson.entity')->find($lessonId);
            $chapter->setLesson($lesson);
        }

        $type = new ChapterType();

        $tmpPhoto = $this->tmpPhotoHandle($chapter);

        $form = $this->getForm($request,$type,$chapter);
        if($form->isValid())
        {
            $this->processForm($form,$chapter,$tmpPhoto);
            $this->flash('success' , '章节添加成功');
            return $this->to('create_chapter' , ['lessonId' => $lessonId]);
        }
        $this->resetEntity($chapter , $tmpPhoto);

        return ['form'=>$form->createView() , 'lesson'=>$lesson];
    }


    public function emailAction()
    {
        return new Response(
            $this->get('mail.notify')->notify('notify service test' , 'This is a message from App\BackendBundle\Mailer\Mailer') ? '发送成功' : '发送失败'
        );
    }

    /**
     * @Route("/create_category" , name="create_category")
     * @Template()
     */
    public function categoryAction(Request $request)
    {

        $category = new Category();
        $categoryType = new CategoryType();
        $form = $this->getForm($request,$categoryType,$category);
        if($form->isValid())
        {
            $em = $this->getEntityManager();
            $em->persist($category);
            $em->flush();
            $this->flash('success' , '分类添加成功');
            return $this->to('create_category');
        }

        $categories = $this->get('category.entity')->findAll();
        return ['form'=>$form->createView(),'categories'=>$categories];
    }
}
