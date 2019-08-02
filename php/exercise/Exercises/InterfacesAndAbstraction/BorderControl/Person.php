<?php

abstract class Person
{
    private $id;

    /**
     * Person constructor.
     * @param $id
     */
    protected function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
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


}