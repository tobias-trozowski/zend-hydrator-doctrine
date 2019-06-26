<?php
declare(strict_types=1);

namespace TobiasTest\Zend\Hydrator\Doctrine\Asset;

use Zend\Hydrator\Strategy\StrategyInterface;

final class SimpleStrategy implements StrategyInterface
{
    public function extract($value, ?object $object = null)
    {
        return 'modified while extracting';
    }
    public function hydrate($value, ?array $data)
    {
        return 'modified while hydrating';
    }
}
