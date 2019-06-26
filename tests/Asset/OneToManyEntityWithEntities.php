<?php
declare(strict_types=1);

namespace TobiasTest\Zend\Hydrator\Doctrine\Asset;

use Doctrine\Common\Collections\ArrayCollection;

final class OneToManyEntityWithEntities extends OneToManyEntity
{
    public function __construct(ArrayCollection $entities = null)
    {
        $this->entities = $entities;
    }
    public function getEntities($modifyValue = true)
    {
        return $this->entities;
    }
}
