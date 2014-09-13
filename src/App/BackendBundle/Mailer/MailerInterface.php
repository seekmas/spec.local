<?php

namespace App\BackendBundle\Mailer;

use Symfony\Component\DependencyInjection\ContainerInterface;

interface MailerInterface
{
    public function __construct(ContainerInterface $service_container , $from);

    public function notify($subject,$body);
}