<?php

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