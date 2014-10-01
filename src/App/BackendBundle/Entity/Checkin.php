<?php

namespace App\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Checkin
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Checkin
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User" , inversedBy="checkin")
     * @ORM\JoinColumn(name="user_id" , referencedColumnName="id")
     */
    private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="checkin_at", type="datetime")
     */
    private $checkinAt;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Checkin
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set checkinAt
     *
     * @param \DateTime $checkinAt
     * @return Checkin
     */
    public function setCheckinAt($checkinAt)
    {
        $this->checkinAt = $checkinAt;

        return $this;
    }

    /**
     * Get checkinAt
     *
     * @return \DateTime 
     */
    public function getCheckinAt()
    {
        return $this->checkinAt;
    }
}
