<?php

class Trainer
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $numberOfBadges;

    /**
     * @var Pokemon[]
     */
    private $pokemons;

    /**
     * Trainer constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->numberOfBadges = 0;
        $this->pokemons = [];
    }

    /**
     * @return int
     */
    public function getNumberOfBadges(): int
    {
        return $this->numberOfBadges;
    }


    public function addPokemon(Pokemon $pokemon){
        $this->pokemons[] = $pokemon;
    }

    public function battle(string $element){
        $found = false;
        foreach ($this->pokemons as $pokemon){
            if($pokemon->getElement() == $element){
                $found = true;
                break;
            }
        }

        if($found){
            $this->increaseBadges();
        }else{
            $this->damagePokemons();
        }

    }

    public function increaseBadges(){
        return $this->numberOfBadges++;
    }

    public function damagePokemons(){

        foreach ($this->pokemons as $pokemon){
            $pokemon->loseHealth();
        }

        $this->pokemons = array_filter($this->pokemons, function (Pokemon $pokemon) {
            return $pokemon->isAlive();
        });
    }


    public function __toString()
    {
        $sizeOfPokemons = count($this->pokemons);
        return "{$this->name} {$this->numberOfBadges} {$sizeOfPokemons}\n";
    }

}