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
        $logger = $this->get('logger');
        $logger->info('I just got the logger');

        $process = new Process('/home/wwwroot/local/spec.local/app/console swiftmailer:debug');
        $process->run();

        if( !$process->isSuccessful())
        {
            throw new \RuntimeException($process->getErrorOutput());
        }

        echo '<pre>';
        echo $process->getOutput();

        return new Response('');
    }

    public function emailAction()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('service@symfonytutorial.com')
            ->setTo('446146366@qq.com')
            ->setBody('Date Notification - Now time is :'.date('Y-m-d H:i:s'))
        ;

        echo $this->get('mailer')->send($message);

        return new Response('');
    }

}
