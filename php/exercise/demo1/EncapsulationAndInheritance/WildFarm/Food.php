<?php

abstract class Food
{
    /**
     * @var integer
     */
    private $quantity;

    protected function __construct(
        int $quantity
    )
    {
        $this->setQuantity($quantity);
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    private function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public abstract function getClassName(): string;

}