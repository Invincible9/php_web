<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="content", type="text")
     */
    private $content;


    /**
     * @var string
     * @ORM\Column(name="pictureUrl", type="text")
     */
    private $pictureUrl;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var \DateTime
     * @Assert\NotBlank()
     * @ORM\Column(name="dateAdded", type="datetime")
     */
    private $dateAdded;

    /**
     * @var string
     */
    private $summary;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", options={"default" : 30})
     */
    private $quantity;

    /**
     * @var int
     * @ORM\Column(name="authorId", type="integer")
     */
    private $authorId;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ProductCart", mappedBy="product")
     */
    private $productBuy;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="product")
     */
    private $productOrder;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="products")
     * @ORM\JoinColumn(name="authorId", referencedColumnName="id")
     */
    private $author;


    /**
     * @var int
     *
     * @ORM\Column(name="viewCount", type="integer")
     */
    private $viewCount;


//    /**
//     * @var User
//     *
//     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cart")
//     * @ORM\JoinColumn(name="authorId", referencedColumnName="id")
//     */
//    private $customer;

    /**
     * @param \App\Entity\User $author
     *
     * @return Product
     */
    public function setAuthor(User $author = null)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return \App\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return int
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @param integer $authorId
     * @return Product
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
        return $this;
    }


    /**
     * @return string
     */
    public function getSummary()
    {
        if ($this->summary === null) {
            $this->setSummary();
        }
        return $this->summary;
    }

    public function setSummary()
    {
        $this->summary = substr($this->getContent(), 0, strlen($this->getContent()) / 2) . '...';
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Product
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return Product
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    public function __construct()
    {
        $this->dateAdded = new \DateTime('now');
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getPictureUrl()
    {
        return $this->pictureUrl;
    }

    /**
     * @param string $pictureUrl
     */
    public function setPictureUrl(string $pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return ArrayCollection
     */
    public function getProductBuy()
    {
        return $this->productBuy;
    }

    /**
     * @param ArrayCollection $productBuy
     */
    public function setProductBuy(ArrayCollection $productBuy)
    {
        $this->productBuy = $productBuy;
    }

    /**
     * @return int
     */
    public function getViewCount()
    {
        return $this->viewCount;
    }

    /**
     * @param int $viewCount
     */
    public function setViewCount(int $viewCount)
    {
        $this->viewCount = $viewCount;
    }

    /**
     * @return ArrayCollection
     */
    public function getProductOrder()
    {
        return $this->productOrder;
    }

    /**
     * @param ArrayCollection $productOrder
     */
    public function setProductOrder(ArrayCollection $productOrder)
    {
        $this->productOrder = $productOrder;
    }

//    /**
//     * @return User
//     */
//    public function getCustomer()
//    {
//        return $this->customer;
//    }
//
//    /**
//     * @param User $customer
//     */
//    public function setCustomer(User $customer)
//    {
//        $this->customer = $customer;
//    }

}

