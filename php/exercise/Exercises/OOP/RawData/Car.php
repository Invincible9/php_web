<?php

class Car {
    /**
     * @var string
     */
    private $model;

    /**
     * @var Cargo
     */
    private $cargo;

    /**
     * @var Engine
     */
    private $engine;

    /**
     * @var array
     */
    private $tires;

    /**
     * Car constructor.
     * @param string $model
     * @param Engine $engine
     * @param Cargo $cargo
     */
    public function __construct(string $model, Engine $engine, Cargo $cargo)
    {
        $this->model = $model;
        $this->engine = $engine;
        $this->cargo = $cargo;
        $this->tires = [];
    }

    /**
     * @param Tire $tire
     */
    public function addTire(Tire $tire){
        $this->tires[] = $tire;
    }

    /**
     * @return array
     */
    public function getTires(): array
    {
        return $this->tires;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }



    /**
     * @return Cargo
     */
    public function getCargo(): Cargo
    {
        return $this->cargo;
    }

    /**
     * @return Engine
     */
    public function getEngine(): Engine
    {
        return $this->engine;
    }





}