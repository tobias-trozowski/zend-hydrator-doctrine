<?php
declare(strict_types=1);

namespace Tobias\Zend\Hydrator\Doctrine\Strategy;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Inflector\Inflector;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use InvalidArgumentException;
use ReflectionException;
use Zend\Hydrator\Strategy\StrategyInterface;
use function get_class;
use function method_exists;
use function spl_object_hash;
use function sprintf;
use function strcmp;

abstract class AbstractCollectionStrategy implements StrategyInterface
{
    /**
     * @var string
     */
    protected $collectionName;

    /**
     * @var ClassMetadata
     */
    protected $metadata;

    /**
     * @var object
     */
    protected $object;

    /**
     * Set the name of the collection
     *
     * @param string $collectionName
     *
     * @return AbstractCollectionStrategy
     */
    public function setCollectionName(string $collectionName): StrategyInterface
    {
        $this->collectionName = $collectionName;
        return $this;
    }

    /**
     * Get the name of the collection
     *
     * @return string
     */
    public function getCollectionName(): string
    {
        return $this->collectionName;
    }

    /**
     * Set the class metadata
     *
     * @param ClassMetadata $classMetadata
     *
     * @return AbstractCollectionStrategy
     */
    public function setClassMetadata(ClassMetadata $classMetadata): StrategyInterface
    {
        $this->metadata = $classMetadata;
        return $this;
    }

    /**
     * Get the class metadata
     *
     * @return ClassMetadata
     */
    public function getClassMetadata(): ClassMetadata
    {
        return $this->metadata;
    }

    /**
     * Set the object
     *
     * @param object $object
     *
     * @return AbstractCollectionStrategy
     * @throws \InvalidArgumentException
     *
     */
    public function setObject(object $object): StrategyInterface
    {
        $this->object = $object;
        return $this;
    }

    /**
     * Get the object
     *
     * @return object
     */
    public function getObject(): object
    {
        return $this->object;
    }

    /**
     * {@inheritDoc}
     */
    public function extract($value, ?object $object = null)
    {
        return $value;
    }

    /**
     * Return the collection by value (using the public API)
     *
     * @return Collection
     * @throws InvalidArgumentException
     *
     */
    protected function getCollectionFromObjectByValue(): iterable
    {
        $object = $this->getObject();
        $getter = 'get' . Inflector::classify($this->getCollectionName());
        if (!method_exists($object, $getter)) {
            throw new InvalidArgumentException(
                sprintf(
                    'The getter %s to access collection %s in object %s does not exist',
                    $getter,
                    $this->getCollectionName(),
                    get_class($object)
                )
            );
        }
        return $object->$getter();
    }

    /**
     * Return the collection by reference (not using the public API)
     *
     * @return Collection
     * @throws ReflectionException
     */
    protected function getCollectionFromObjectByReference(): Collection
    {
        $object = $this->getObject();
        $refl = $this->getClassMetadata()->getReflectionClass();
        $reflProperty = $refl->getProperty($this->getCollectionName());
        $reflProperty->setAccessible(true);
        return $reflProperty->getValue($object);
    }

    /**
     * This method is used internally by array_udiff to check if two objects are equal, according to their
     * SPL hash. This is needed because the native array_diff only compare strings
     *
     * @param object $a
     * @param object $b
     *
     * @return int
     */
    protected function compareObjects(object $a, object $b): int
    {
        return strcmp(spl_object_hash($a), spl_object_hash($b));
    }
}
