<?php

namespace App\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;

class FirstController extends Controller
{
    public function indexAction(Request $request)
    {
        $subject = 'Refactoring a Symfony 2 Controller with PhpSpec ';
        $body = 'Hello world';
        $template = $this->get('templating')->render('AppBackendBundle:MailTemplating:default.html.twig' , ['subject'=>$subject,'body'=>$body]);
        return new Response($template);
    }

    public function processAction()
    {
        $logger = $this->get('logger');
        $logger->info('I just got the logger');

        $process = new Process('/home/wwwroot/local/spec.local/app/console container:debug');
        $process->run();

        if( !$process->isSuccessful())
        {
            throw new \RuntimeException($process->getErrorOutput());
        }

        echo '<pre>';
        echo $process->getOutput();
    }


    public function emailAction()
    {
        return new Response(
            $this->get('mail.notify')->notify('notify service test' , 'This is a message from App\BackendBundle\Mailer\Mailer') ? '发送成功' : '发送失败'
        );
    }

}
