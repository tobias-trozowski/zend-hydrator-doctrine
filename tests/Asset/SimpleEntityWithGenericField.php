<?php
declare(strict_types=1);

namespace TobiasTest\Zend\Hydrator\Doctrine\Asset;

final class SimpleEntityWithGenericField
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var float
     */
    protected $genericField;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setGenericField($value)
    {
        $this->genericField = $value;
        return $this;
    }

    public function getGenericField()
    {
        return $this->genericField;
    }
}
