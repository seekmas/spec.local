<?php

namespace App\FrontendBundle\Controller;

use App\BackendBundle\Controller\CoreController;
use App\BackendBundle\Entity\Reply;
use App\BackendBundle\Entity\Thread;
use App\BackendBundle\Form\ReplyType;
use App\BackendBundle\Form\ThreadType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class ForumController extends CoreController
{
    /**
     * @Route("/forum" , name="forum")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $new = new Thread();
        $type = new ThreadType();
        $form = $this->getForm($request,$type,$new);
        if($form->isValid())
        {
            $user = $this->getUser();
            $new->setIsLocked(false);
            $new->setUser($user);
            $this->processForm($form,$new);
            $this->flash('success' , '发帖成功');
            return $this->to('forum');
        }

        $threads = $this->get('thread.paginator')->setPerpage(30)->getPagination();

        return ['form'=>$form->createView(),'threads' => $threads];
    }

    /**
     * @Route("/{id}/forum" , name="thread")
     * @Template()
     */
    public function threadAction(Request $request, $id)
    {
        $thread = $this->get('thread.entity')->find($id);
        if($thread == null)
        {
            return ['wasNotExist' => true];
        }

        $reply = new Reply();
        $type = new ReplyType();
        $form = $this->getForm($request,$type,$reply);
        if($form->isValid())
        {
            $user = $this->getUser();
            $reply->setThread($thread);
            $reply->setUser($user);
            $reply->setIsLocked(false);
            $reply->setCreatedAt(new \Datetime());

            $this->processForm($form,$reply);
            $this->flash('success' , '回复成功');
            return $this->to('thread' , ['id'=>$id]);
        }

        $replies = $this->get('reply.paginator')
             ->where(['threadId'=>$thread->getId()])
             ->setPerpage(20)
             ->getPagination();

        return ['thread'=>$thread,'replies'=>$replies,'form'=>$form->createView()];
    }
}