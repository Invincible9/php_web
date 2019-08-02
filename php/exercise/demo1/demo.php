<?php

class Student {
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $age;

    /**
     * @var array
     */
    private $grades;

    /**
     * Student constructor.
     * @param $name
     * @param $age
     */
    public function __construct(
        string $name = null,
        int $age = null)
    {
        $this->name = $name;
        $this->age = $age;
        $this->grades = [];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }



    public function __toString()
    {
        return $this->name . " " . $this->age;
    }


}

/** @var Student $student */


$students[] = new Student("Maria");
$students[] = new Student("Pesho");
$students[] = new Student("Gosho", 20);

/** @var Student $student */
foreach ($students as $student){
    echo $student . PHP_EOL;
}
