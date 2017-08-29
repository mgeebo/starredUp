<?php

namespace AppBundle\Entity;

use DateTime;
use Swagger\Annotations as SWG;


trait BaseTrait
{
    /** @ORM\Column(name="is_active", type="boolean")
    */
    protected $isActive = 1;

    /** @ORM\Column(name="create_date", type="datetime")
     */
    protected $createDate;

    /** @ORM\Column(name="modify_date", type="datetime")
     */
    protected $modifyDate;

    public function __construct()
    {
        if (!isset($this->createDate)) {
            $this->createDate = new DateTime();
        }
        $this->isActive = true;
        $this->modifyDate = new DateTime();
    }
    /**
     * @return integer
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param integer $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @param DateTime $createDate
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }

    /**
     * @return DateTime
     */
    public function getModifyDate()
    {
        return $this->modifyDate;
    }

    /**
     * @param DateTime $modifyDate
     */
    public function setModifyDate($modifyDate)
    {
        $this->modifyDate = $modifyDate;
    }
}