<?php

abstract class Mammal extends Animal
{
    /**
     * @var string
     */
    private $livingRegion;

    public function __construct(string $name,
                                string $type,
                                float $weight,
                                string $livingRegion)
    {
        parent::__construct($name, $type, $weight);
        $this->setLivingRegion($livingRegion);
    }

    /**
     * @return string
     */
    public function getLivingRegion(): string
    {
        return $this->livingRegion;
    }

    /**
     * @param string $livingRegion
     */
    private function setLivingRegion(string $livingRegion): void
    {
        $this->livingRegion = $livingRegion;
    }

    public function __toString()
    {
        return sprintf("%s[%s, %s, %s, %d]\n",
            $this->getType(),
            $this->getName(),
            $this->getWeight(),
            $this->getLivingRegion(),
            $this->getFoodEaten()
        );
    }

}