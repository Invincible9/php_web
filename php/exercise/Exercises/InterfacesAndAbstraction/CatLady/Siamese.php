<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.10.2018 г.
 * Time: 14:03
 */

class Siamese extends Cat
{
    private $earSize;

    public function __construct(string $breed, string $name, $earSize)
    {
        parent::__construct($breed, $name);
        $this->setEarSize($earSize);
    }

    /**
     * @return mixed
     */
    public function getEarSize()
    {
        return $this->earSize;
    }

    /**
     * @param mixed $earSize
     */
    private function setEarSize($earSize): void
    {
        $this->earSize = $earSize;
    }

    public function __toString()
    {
        return parent::__toString() . $this->getEarSize() . PHP_EOL;
    }


}