<?php

//spl_autoload_register();

class Book
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $author;

    /**
     * @var float
     */
    private $price;

    /**
     * Book constructor.
     * @param string $title
     * @param string $author
     * @param float $price
     * @throws Exception
     */
    public function __construct(string $author, string $title,
                                float $price)
    {
        $this->setAuthor($author);
        $this->setTitle($title);
        $this->setPrice($price);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @throws Exception
     */
    private function setTitle(string $title)
    {
        if(strlen($title) < 3){
            throw new Exception("Title not valid!");
        }
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @throws Exception
     */
    private function setAuthor(string $author)
    {
        if(is_numeric(explode(" ", $author)[1][0])){
            throw new Exception("Author not valid!");
        }

        $this->author = $author;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @throws Exception
     */
    private function setPrice(float $price)
    {
        if($price <= 0){
            throw new Exception("Price not valid!");
        }
        $this->price = $price;
    }

}

class GoldenEditionBook extends Book
{
    public function IncreasePrice(){
        return parent::getPrice() * 1.3;
    }

}

$author = readline();
$title = readline();
$price = floatval(readline());
$type = readline();

$book = null;
try {
    switch ($type) {
        case "GOLD":
            $book = new GoldenEditionBook($author, $title, $price);
            $book->IncreasePrice();
            break;
        case "STANDARD":
            $book = new Book($author, $title, $price);
            break;
        default:
            throw new Exception("Type is not valid!");
            break;
    }
    echo "OK\n";
    echo $book->getPrice() . PHP_EOL;

}catch (Exception $ex){
    echo $ex->getMessage();
}



