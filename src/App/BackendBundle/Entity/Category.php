<?php

namespace App\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Category
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Lesson" , mappedBy="category")
     */
    private $lesson;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort_id", type="integer")
     */
    private $sortId;


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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $lesson
     */
    public function setLesson($lesson)
    {
        $this->lesson = $lesson;
    }

    /**
     * @return mixed
     */
    public function getLesson()
    {
        return $this->lesson;
    }

    /**
     * Set sortId
     *
     * @param integer $sortId
     * @return Category
     */
    public function setSortId($sortId)
    {
        $this->sortId = $sortId;

        return $this;
    }

    /**
     * Get sortId
     *
     * @return integer 
     */
    public function getSortId()
    {
        return $this->sortId;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
