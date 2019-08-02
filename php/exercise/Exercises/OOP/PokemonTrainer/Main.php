<?php

//require_once "Pokemon.php";
//require_once "Trainer.php";

class Pokemon
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $element;

    /**
     * @var int
     */
    private $health;

    /**
     * Pokemon constructor.
     * @param string $name
     * @param string $element
     * @param int $health
     */
    public function __construct(string $name, string $element, int $health)
    {
        $this->name = $name;
        $this->element = $element;
        $this->health = $health;
    }

    public function loseHealth()
    {
        return $this->health -= 10;
    }

    public function isAlive()
    {
        return $this->health > 0;
    }

    /**
     * @return string
     */
    public function getElement(): string
    {
        return $this->element;
    }
}

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


$trainers = [];

while (true){
    $input = explode(" ", readline());

    if($input[0] == "Tournament"){
        break;
    }

    $trainerName = $input[0];

    $pokemonName = $input[1];
    $pokemonElement = $input[2];
    $pokemonHealth = intval($input[3]);

    if(!array_key_exists($trainerName, $trainers)){
        $trainer = new Trainer($trainerName);
        $trainers[$trainerName] = $trainer;
    }

    $pokemon = new Pokemon($pokemonName, $pokemonElement, $pokemonHealth);
    $trainers[$trainerName]->addPokemon($pokemon);
}

$element = readline();
while ($element != "End"){

    foreach($trainers as $trainer){
        $trainer->battle($element);
    }

    $element = readline();
}

usort($trainers, function (Trainer $t1, Trainer $t2) {
    return $t2->getNumberOfBadges() <=> $t1->getNumberOfBadges();
});

foreach($trainers as $trainer){
    echo $trainer;
}
