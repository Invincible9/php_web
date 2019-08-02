<?php

//spl_autoload_register();

interface IBirthable
{
    public function setBirthdate(string  $birthDate): void;
}

interface IIdentity
{
    public function setId(string $id) : void;
}

interface Person
{
    public function setName(string $name) : void;
    public function setAge (int $age) : void;
}

class Citizen implements Person, Identity, IBirthable
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

    public function __construct(string $name, int $age, $id, $birthdate)
    {
        $this->setName($name);
        $this->setAge($age);
        $this->setId($id);
        $this->setBirthdate($birthdate);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function setBirthdate(string $birthDate): void
    {
        $this->birthdate = $birthDate;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function __toString()
    {
        return "{$this->getName()}\n{$this->getAge()}\n{$this->id}\n{$this->birthdate}\n";
    }
}

$name = readline();
$age = intval(readline());
$id = readline();
$birthdate = readline();

$citizen = new Citizen($name, $age, $id, $birthdate);
echo $citizen;

