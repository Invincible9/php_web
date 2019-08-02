<?php

//require_once "Person.php";
//require_once "Family.php";

class Person {

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $age;

    /**
     * Person constructor.
     * @param string $name
     * @param int $age
     */
    public function __construct(string $name, int $age)
    {
        $this->setName($name);
        $this->setAge($age);
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

    /**
     * @param string $name
     */
    private function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param int $age
     */
    private function setAge(int $age)
    {
        $this->age = $age;
    }



    public function __toString()
    {
        return "{$this->getName()} {$this->getAge()}\n";
    }
}

class Family {

    /**
     * @var Person[]
     */
    private $peoples;

    public function addMember(Person $member){
        $this->peoples[] = $member;
    }

    public function getOldestMember(){
        $members = $this->peoples;

        usort($members, function (Person $p1, Person $p2) {
            return $p2->getAge() <=> $p1->getAge();
        });

        return $members[0];
    }
}


$n = intval(readline());

$family = new Family();

while($n-- > 0){
    $data = explode(" ", readline());

    $name = $data[0];
    $age = intval($data[1]);

    $person = new Person($name, $age);

    $family->addMember($person);
}

echo $family->getOldestMember();
