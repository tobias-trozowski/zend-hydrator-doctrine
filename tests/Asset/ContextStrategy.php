<?php
declare(strict_types=1);

namespace TobiasTest\Zend\Hydrator\Doctrine\Asset;

use Zend\Hydrator\Strategy\StrategyInterface;

final class ContextStrategy implements StrategyInterface
{
    public function extract($value, ?object $object = null)
    {
        return (string) $value . $object->getField();
    }
    public function hydrate($value, ?array $data = null)
    {
        return $value . $data['field'];
    }
}
