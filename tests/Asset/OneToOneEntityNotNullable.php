<?php
declare(strict_types=1);

namespace TobiasTest\Zend\Hydrator\Doctrine\Asset;

final class OneToOneEntityNotNullable
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ByValueDifferentiatorEntity
     */
    protected $toOne;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setToOne(ByValueDifferentiatorEntity $entity, $modifyValue = true)
    {
        // Modify the value to illustrate the difference between by value and by reference
        if ($modifyValue) {
            $entity->setField('Modified from setToOne setter', false);
        }
        $this->toOne = $entity;
    }

    public function getToOne($modifyValue = true)
    {
        // Make some modifications to the association so that we can demonstrate difference between
        // by value and by reference
        if ($modifyValue) {
            $this->toOne->setField('Modified from getToOne getter', false);
        }
        return $this->toOne;
    }
}
