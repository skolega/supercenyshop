<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ProductVariant
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ProductVariant
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;

    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="smallint")
     */
    private $height;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="surfance", type="string", length=255)
     */
    private $surfance;

    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="packing", type="decimal")
     */
    private $packing;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="dimensions", type="string", length=255)
     */
    private $dimensions;

    /**
     * @var string
     *
     * @ORM\Column(name="buy_value", type="decimal")
     */
    private $buyValue;
    
    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="variants")
     * 
     * @Assert\NotNull(message="Proszę wybrać odpowiednią kategorię")
     */
    private $product;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return ProductVariant
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return ProductVariant
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return ProductVariant
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return ProductVariant
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set surfance
     *
     * @param string $surfance
     * @return ProductVariant
     */
    public function setSurfance($surfance)
    {
        $this->surfance = $surfance;

        return $this;
    }

    /**
     * Get surfance
     *
     * @return string 
     */
    public function getSurfance()
    {
        return $this->surfance;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return ProductVariant
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set packing
     *
     * @param string $packing
     * @return ProductVariant
     */
    public function setPacking($packing)
    {
        $this->packing = $packing;

        return $this;
    }

    /**
     * Get packing
     *
     * @return string 
     */
    public function getPacking()
    {
        return $this->packing;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ProductVariant
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dimensions
     *
     * @param string $dimensions
     * @return ProductVariant
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    /**
     * Get dimensions
     *
     * @return string 
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * Set buyValue
     *
     * @param string $buyValue
     * @return ProductVariant
     */
    public function setBuyValue($buyValue)
    {
        $this->buyValue = $buyValue;

        return $this;
    }

    /**
     * Get buyValue
     *
     * @return string 
     */
    public function getBuyValue()
    {
        return $this->buyValue;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     * @return ProductVariant
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
