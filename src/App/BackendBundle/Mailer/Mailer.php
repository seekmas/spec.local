<?php
namespace App\BackendBundle\Mailer;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @Service("mail.notify", public=true)
 */
class Mailer implements MailerInterface
{
    protected $service_container;

    protected $from;

    /**
     * @DI\InjectParams({
     *      "service_container" = @DI\Inject("service_container")
     * })
     */
    public function __construct(ContainerInterface $service_container)
    {
        $this->service_container = $service_container;
    }


    public function notify($subject, $body)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            //->setFrom('service')
            ->setTo( $user->getEmail() )
            ->setBody($body)
        ;

        return $this->get('mailer')->send($message) ? true : false;

    }

    protected function get($service)
    {
        if( $this->service_container->has($service))
        {
            return $this->service_container->get($service);
        }else
        {
            throw new ServiceNotFoundException($service);
        }
    }

    function __invoke()
    {
        return 'Mailer Notify Service';
    }

}
