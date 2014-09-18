<?php

namespace App\BackendBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Privates" , mappedBy="user")
     */
    protected $privates;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @param mixed $privates
     */
    public function setPrivates($privates)
    {
        $this->privates = $privates;
    }

    /**
     * @return mixed
     */
    public function getPrivates()
    {
        return $this->privates;
    }
}