<?php
declare(strict_types=1);

namespace TobiasTest\Zend\Hydrator\Doctrine\Asset;

final class NamingStrategyEntity
{
    /**
     * @var null|string
     */
    protected $camelCase;
    /**
     * @param $camelCase
     */
    public function __construct(?string $camelCase = null)
    {
        $this->camelCase = $camelCase;
    }
    /**
     * @param null|string $camelCase
     */
    public function setCamelCase(?string $camelCase)
    {
        $this->camelCase = $camelCase;
    }
    /**
     * @return null|string
     */
    public function getCamelCase(): ?string
    {
        return $this->camelCase;
    }
}
