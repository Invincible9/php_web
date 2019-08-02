<?php

abstract class Cat
{
    /**
     * @var string
     */
    private $breed;

    /**
     * @var string
     */
    private $name;

    protected function __construct(string $breed, string $name)
    {
        $this->setBreed($breed);
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function getBreed(): string
    {
        return $this->breed;
    }

    /**
     * @param string $breed
     */
    private function setBreed(string $breed): void
    {
        $this->breed = $breed;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    private function setName(string $name): void
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->getBreed() . " " . $this->getName();
    }

}

class Cymric extends Cat
{
    /**
     * @var int
     */
    private $furLength;

    public function __construct(string $breed, string $name,
                                int $furLength)
    {
        parent::__construct($breed, $name);
        $this->setFurLength($furLength);
    }

    /**
     * @return int
     */
    public function getFurLength()
    {
        return $this->furLength;
    }

    /**
     * @param int $furLength
     */
    private function setFurLength(int $furLength): void
    {
        $this->furLength = $furLength;
    }

    public function __toString()
    {
        return parent::__toString() . " " . $this->getFurLength() . PHP_EOL;
    }

}

class Siamese extends Cat
{
    private $earSize;

    public function __construct(
        string $breed,
        string $name,
        int $earSize)
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
        return parent::__toString() . " " . $this->getEarSize() . PHP_EOL;
    }

}

class StreetExtraordinaire extends Cat
{
    /**
     * @var int
     */
    private $decibelsOfMeows;

    public function __construct(string $breed, string $name,
                                int $decibelsOfMeows)
    {
        parent::__construct($breed, $name);
        $this->setDecibelsOfMeows($decibelsOfMeows);
    }

    /**
     * @return int
     */
    public function getDecibelsOfMeows(): int
    {
        return $this->decibelsOfMeows;
    }

    /**
     * @param int $decibelsOfMeows
     */
    private function setDecibelsOfMeows(int $decibelsOfMeows): void
    {
        $this->decibelsOfMeows = $decibelsOfMeows;
    }

    public function __toString()
    {
        return parent::__toString() . " " . $this->getDecibelsOfMeows() . PHP_EOL;
    }


}

interface CatFactoryInterface
{
    public static function create(string $breed, string $name, int $param) : Cat;

}

class CatFactory implements CatFactoryInterface
{

    /**
     * @param string $breed
     * @param string $name
     * @param int $param
     * @return Cat
     * @throws Exception
     */
    public static function create(string $breed, string $name, int $param): Cat
    {
        if(!class_exists($breed)){
            throw new Exception("");
        }

        return new $breed($breed, $name, $param);
    }
}

class Main
{
    const PATTERN = "/\\s+/";
    const INPUT_END_COMMAND = "End";

    /**
     * @var array
     */
    private $cats;

    public function run()
    {
        $this->readData();
    }

    private function findCatByName(string $name): Cat
    {
        if (array_key_exists($name, $this->cats)) {
            return $this->cats[$name];
        }
        return null;
    }

    private function readData()
    {
        $input = readline();

        while ($input !== self::INPUT_END_COMMAND) {
            $data = preg_split(self::PATTERN,
                $input, -1, PREG_SPLIT_NO_EMPTY);

            $breed = $data[0];
            $name = $data[1];
            $param = intval($data[2]);

            $cat = null;
            try {
                $this->cats[$name] = CatFactory::create($breed, $name, $param);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }

            $input = readline();
        }

        $searchingName = readline();
        $cat = $this->findCatByName($searchingName);
        echo $cat;
    }
}

$main = new Main();
$main->run();