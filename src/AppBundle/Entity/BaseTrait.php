<?php

namespace AppBundle\Entity;

use DateTime;

trait BaseTrait
{
    /** @ORM\Column(type="boolean") */
    protected $is_active = 1;

    /** @ORM\Column(type="datetime") */
    protected $create_date;

    /** @ORM\Column(type="datetime") */
    protected $modify_date;

    public function __construct()
    {
        if (!isset($this->create_date)) {
            $this->create_date = new DateTime();
        }
        $this->is_active = true;
        $this->modify_date = new DateTime();
    }
    /**
     * @return integer
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * @param integer $is_active
     */
    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;
    }

    /**
     * @return DateTime
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * @param DateTime $create_date
     */
    public function setCreateDate($create_date)
    {
        $this->create_date = $create_date;
    }

    /**
     * @return DateTime
     */
    public function getModifyDate()
    {
        return $this->modify_date;
    }

    /**
     * @param DateTime $modify_date
     */
    public function setModifyDate($modify_date)
    {
        $this->modify_date = $modify_date;
    }
}