<?php
declare(strict_types=1);

namespace Tobias\Zend\Hydrator\Doctrine\Strategy;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Inflector\Inflector;
use LogicException;
use function array_udiff;
use function get_class;
use function method_exists;
use function sprintf;

/**
 * When this strategy is used for Collections, if the new collection does not contain elements that are present in
 * the original collection, then this strategy will not remove those elements. At most, it will add new elements. For
 * instance, if the collection initially contains elements A and B, and that the new collection contains elements B
 * and C, then the final collection will contain elements A, B and C.
 *
 * This strategy is by value, this means it will use the public API (in this case, remover)
 */
final class DisallowRemoveByValue extends AbstractCollectionStrategy
{
    public function hydrate($value, ?array $data)
    {
        // AllowRemove strategy need "adder"
        $adder = 'add' . Inflector::classify($this->collectionName);
        if (!method_exists($this->object, $adder)) {
            throw new LogicException(
                sprintf(
                    'DisallowRemove strategy for DoctrineModule hydrator requires %s to
                     be defined in %s entity domain code, but it seems to be missing',
                    $adder,
                    get_class($this->object)
                )
            );
        }
        $collection = $this->getCollectionFromObjectByValue();
        if ($collection instanceof Collection) {
            $collection = $collection->toArray();
        }
        $toAdd = new ArrayCollection(array_udiff($value, $collection, [$this, 'compareObjects']));
        $this->object->$adder($toAdd);
        return $collection;
    }
}
