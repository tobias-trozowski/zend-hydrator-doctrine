<?php
declare(strict_types=1);

namespace TobiasTest\Zend\Hydrator\Doctrine\Asset;

final class SimpleEntityWithIsBoolean
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var bool
     */
    protected $isActive;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = (bool)$isActive;
    }

    public function isActive()
    {
        return $this->isActive;
    }

    public function getIsActive()
    {
        return $this->isActive();
    }
}
