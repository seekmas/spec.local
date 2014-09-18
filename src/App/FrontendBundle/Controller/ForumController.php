<?php

namespace App\FrontendBundle\Controller;

use App\BackendBundle\Controller\CoreController;
use App\BackendBundle\Entity\Thread;
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

        $threads = $this->get('thread.paginator')->getPagination();

        return ['form'=>$form->createView(),'threads' => $threads];
    }

    /**
     * @Route("/{id}/forum" , name="thread")
     * @Template()
     */
    public function threadAction(Request $request, $id)
    {
        $thread = $this->get('thread.entity')->find($id);
        return ['thread'=>$thread];
    }
}