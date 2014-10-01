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
     * @ORM\Column(name="name" , type="string" , length=255 , nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(name="job" , type="string" , length=255 , nullable=true)
     */
    protected $job;

    /**
     * @ORM\Column(name="company" , type="string" , length=255 , nullable=true)
     */
    protected $company;

    /**
     * @ORM\Column(name="phone" , type="bigint" , nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(name="vocation" , type="string" , length=255 , nullable=true)
     */
    protected $vocation;

    /**
     * @ORM\OneToOne(targetEntity="Privates" , mappedBy="user")
     */
    protected $privates;

    /**
     * @ORM\OneToMany(targetEntity="Checkin" , mappedBy="user")
     */
    protected $checkin;

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

    /**
     * @param mixed $checkin
     */
    public function setCheckin($checkin)
    {
        $this->checkin = $checkin;
    }

    /**
     * @return mixed
     */
    public function getCheckin()
    {
        return $this->checkin;
    }
}