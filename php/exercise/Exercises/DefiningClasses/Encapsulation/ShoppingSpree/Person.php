<?php

class Person
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $money;

    /**
     * @var Product[]
     */
    private $products;

    /**
     * Person constructor.
     * @param string $name
     * @param float $money
     * @throws Exception
     */
    public function __construct(string $name, float $money)
    {
        $this->setName($name);
        $this->setMoney($money);
        $this->products = [];
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
     * @throws Exception
     */
    private function setName(string $name)
    {
        if(empty($name)){
            throw new Exception("Name cannot be empty");
        }
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getMoney(): float
    {
        return $this->money;
    }

    /**
     * @param float $money
     * @throws Exception
     */
    private function setMoney(float $money)
    {
        if($money < 0){
            throw new Exception("Money cannot be negative");
        }
        $this->money = $money;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     */
    public function setProducts(array $products)
    {
        $this->products = $products;
    }

    /**
     * @param Product $product
     * @throws Exception
     */
    public function buyProduct(Product $product){
        if($product->getCost() > $this->getMoney()){
            throw new Exception( $this->getName() . " can\'t afford "
                    . $product->getName() . PHP_EOL);
        }

        $this->money -= $product->getCost();
        $this->products[] = $product;
        echo "{$this->getName()} bought {$product->getName()}\n";
    }

    public function __toString()
    {
        if(count($this->products) === 0){
            return "{$this->getName()} - Nothing bought\n";
        }

        $output = $this->getName() . " - ";

        $output .= implode(",",
            array_map(function (Product $product){
               return $product->getName();
        }, $this->products));

        return $output . PHP_EOL;
    }

}