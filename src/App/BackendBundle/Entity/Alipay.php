<?php

namespace App\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alipay
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Alipay
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
     * @ORM\Column(name="pid", type="string", length=255)
     */
    private $pid;

    /**
     * @var string
     *
     * @ORM\Column(name="pkey", type="string", length=255)
     */
    private $pkey;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_default", type="boolean")
     */
    private $isDefault;


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
     * Set pid
     *
     * @param string $pid
     * @return Alipay
     */
    public function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * Get pid
     *
     * @return string 
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * Set pkey
     *
     * @param string $pkey
     * @return Alipay
     */
    public function setPkey($pkey)
    {
        $this->pkey = $pkey;

        return $this;
    }

    /**
     * Get pkey
     *
     * @return string 
     */
    public function getPkey()
    {
        return $this->pkey;
    }

    /**
     * Set isDefault
     *
     * @param boolean $isDefault
     * @return Alipay
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return boolean 
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }
}
