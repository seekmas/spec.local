<?php

namespace App\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 */
class Photo
{
    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255 , nullable=true)
     */
    protected $photo;


    /**
     * Set photo
     *
     * @param string $photo
     * @return Lesson
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}
