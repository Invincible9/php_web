<?php

spl_autoload_register();

interface Identity
{
    public function getFakeId(string $id) : string;
}

class Robot implements Identity
{
    /**
     * @var string
     */
    private $model;

    /**
     * @var string
     */
    private $id;

    public function __construct(string $model, string $id)
    {
        $this->setModel($model);
        $this->setId($id);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    private function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    private function setId(string $id): void
    {
        $this->id = $id;
    }


    public function getFakeId(string $id): string
    {
        $length = strlen($id);
        if(substr($this->getId(), -$length, $length) == $id){
            return $this->getId() . PHP_EOL;
        }else{
            return "";
        }
    }
}

class Citizen implements Identity, IBirthDate
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $age;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $birthdate;

    public function __construct(string $name, int $age, string $id, string $birthdate)
    {
        $this->setName($name);
        $this->setAge($age);
        $this->setId($id);
        $this->birthdate = $birthdate;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
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
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFakeId(string $id): string
    {
        $length = strlen($id);
        if(substr($this->getId(), -$length, $length) == $id){
            return $this->getId() . PHP_EOL;
        }else{
            return "";
        }
    }

    public function getBirthDate(): string
    {
        return $this->birthdate;
    }
}

interface IName {
    public function getName() : string;
}

interface IBirthDate {
    public function getBirthDate() : string;
}

class Pet implements IName , IBirthDate {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $birthdate;

    public function getName(): string
    {
        return $this->name;
    }

    public function getBirthDate(): string
    {
        return $this->birthdate;
    }
}

$citizensAndRobots = [];

while (true){
    $input = explode(" ", readline());

    if($input[0] == "End"){
        break;
    }

    $identity = null;

    $type = $input[0];

    if(class_exists($input[0])){

    }


}

$searchingId = readline();

foreach ($citizensAndRobots as $all){
   echo $all->getFakeId($searchingId);
}
