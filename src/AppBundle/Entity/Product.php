<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 * @Vich\Uploadable
 */
class Product {

    /**
     * @var integer
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
     * 
     * @Assert\NotBlank()
     * @Assert\Length(min=5, minMessage="Tytuł musi mieć conajmniej {{ limit }} znaków.")
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="weight", type="integer")
     * 
     * @Assert\NotBlank()
     * @Assert\Range(min=0)
     */
    private $weight;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="integer")
     * 
     * @Assert\NotBlank()
     * @Assert\Range(min=0)
     */
    private $height;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="width", type="integer")
     * 
     * @Assert\NotBlank()
     * @Assert\Range(min=0)
     */
    private $width;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="length", type="integer")
     * 
     * @Assert\NotBlank()
     * @Assert\Range(min=0)
     */
    private $length;
    
    /**
     * @var string
     *
     * @ORM\Column(name="color", type="text", nullable=true)
     * 
     * @Assert\NotBlank()
     */
    private $color;
    
    /**
     * @var string
     *
     * @ORM\Column(name="product_dimensions", type="text", nullable=true)
     * 
     * @Assert\NotBlank()
     */
    private $product_dimensions;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * 
     * @Assert\NotBlank()
     */
    private $description;
    
    /**
     * @var string
     *
     * @ORM\Column(name="facture", type="text", nullable=true)
     * 
     * @Assert\NotBlank()
     */
    private $facture;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     * 
     * @Assert\NotBlank()
     * @Assert\Range(min=0.01, minMessage="Cena musi być większa lub równa {{ limit }} zł.")
     */
    private $price = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer")
     * 
     * @Assert\NotBlank()
     * @Assert\Range(min=0, minMessage="Dostępna ilość sztuk musi być większa lub równa {{ limit }}.")
     */
    private $amount = 0;

    /**
     * @var decimal
     * 
     * @ORM\Column(name="package", type="decimal", precision=10, scale=2)
     * 
     * @Assert\NotBlank()
     * @Assert\Range(min=0, minMessage="Podana ilość sztuk musi być większa lub równa {{ limit }}.")
     */
    private $package;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * 
     * @Assert\NotNull(message="Proszę wybrać odpowiednią kategorię")
     */
    private $category;
    
    /**
     * @ORM\ManyToOne(targetEntity="ProductType", inversedBy="product")
     * 
     * @Assert\NotNull(message="Proszę wybrać odpowiedni typ produktu")
     */
    private $type;
    
    /**
     * @ORM\OneToMany(targetEntity="ProductVariant", mappedBy="product")
     * 
     * @Assert\NotNull(message="Zaznacz odpowiedni wariant")
     */
    private $variants;
    
    /**
     * @ORM\OneToMany(targetEntity="Manufacturer", mappedBy="product")
     * 
     * @Assert\NotNull(message="Proszę wybrać odpowiedniego producenta")
     */
    private $manufactures;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="product")
     */
    private $comments;

    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     *
     * @var File $imageFile
     */
    private $imageFile;

    /**
     * @ORM\Column(name="image_name", type="string", length=255, nullable=true)
     *
     * @var string $imageName
     */
    private $imageName;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     *
     * @var \DateTime $createdAt
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     *
     * @var \DateTime $updatedAt
     */
    private $updatedAt;
    
    /**
     * @ORM\ManyToMany(targetEntity="ProductAditionalOptions", inversedBy="products")
     */
    private $aditional_options;
    
    /**
     * @ORM\Column(name="cross_sell_product", type="string", length=255, nullable=true)
     */
    private $crossProduct;
   

    public function __toString() {
        return $this->name;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Product
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return Product
     */
    public function setAmount($amount) {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\AppBundle\Entity\Category $category = null) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category 
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comments
     *
     * @param \AppBundle\Entity\Comment $comments
     * @return Product
     */
    public function addComment(\AppBundle\Entity\Comment $comments) {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \AppBundle\Entity\Comment $comments
     */
    public function removeComment(\AppBundle\Entity\Comment $comments) {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments() {
        return $this->comments;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image = null) {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile() {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName) {
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getImageName() {
        return $this->imageName;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }


    /**
     * Set slug
     *
     * @param string $slug
     * @return Product
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Set package
     *
     * @param string $package
     * @return Product
     */
    public function setPackage($package)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return string 
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Product
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Product
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Product
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set manufactures
     *
     * @param \AppBundle\Entity\Manufacturer $manufactures
     * @return Product
     */
    public function setManufactures(\AppBundle\Entity\Manufacturer $manufactures = null)
    {
        $this->manufactures = $manufactures;

        return $this;
    }

    /**
     * Get manufactures
     *
     * @return \AppBundle\Entity\Manufacturer 
     */
    public function getManufactures()
    {
        return $this->manufactures;
    }

    /**
     * Add manufactures
     *
     * @param \AppBundle\Entity\Manufacturer $manufactures
     * @return Product
     */
    public function addManufacture(\AppBundle\Entity\Manufacturer $manufactures)
    {
        $this->manufactures[] = $manufactures;

        return $this;
    }

    /**
     * Remove manufactures
     *
     * @param \AppBundle\Entity\Manufacturer $manufactures
     */
    public function removeManufacture(\AppBundle\Entity\Manufacturer $manufactures)
    {
        $this->manufactures->removeElement($manufactures);
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return Product
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
     * @return Product
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
     * Set width
     *
     * @param integer $width
     * @return Product
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set length
     *
     * @param integer $length
     * @return Product
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return integer 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Product
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
     * Set product_dimensions
     *
     * @param string $productDimensions
     * @return Product
     */
    public function setProductDimensions($productDimensions)
    {
        $this->product_dimensions = $productDimensions;

        return $this;
    }

    /**
     * Get product_dimensions
     *
     * @return string 
     */
    public function getProductDimensions()
    {
        return $this->product_dimensions;
    }

    /**
     * Set facture
     *
     * @param string $facture
     * @return Product
     */
    public function setFacture($facture)
    {
        $this->facture = $facture;

        return $this;
    }

    /**
     * Get facture
     *
     * @return string 
     */
    public function getFacture()
    {
        return $this->facture;
    }

    /**
     * Add variants
     *
     * @param \AppBundle\Entity\ProductVariant $variants
     * @return Product
     */
    public function addVariant(\AppBundle\Entity\ProductVariant $variants)
    {
        $this->variants[] = $variants;

        return $this;
    }

    /**
     * Remove variants
     *
     * @param \AppBundle\Entity\ProductVariant $variants
     */
    public function removeVariant(\AppBundle\Entity\ProductVariant $variants)
    {
        $this->variants->removeElement($variants);
    }

    /**
     * Get variants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * Set crossProduct
     *
     * @param \AppBundle\Entity\Product $crossProduct
     * @return Product
     */
    public function setCrossProduct(\AppBundle\Entity\Product $crossProduct = null)
    {
        $this->crossProduct = $crossProduct;

        return $this;
    }

    /**
     * Get crossProduct
     *
     * @return \AppBundle\Entity\Product 
     */
    public function getCrossProduct()
    {
        return $this->crossProduct;
    }

    /**
     * Set crossSelling
     *
     * @param \AppBundle\Entity\Product $crossSelling
     * @return Product
     */
    public function setCrossSelling(\AppBundle\Entity\Product $crossSelling = null)
    {
        $this->crossSelling = $crossSelling;

        return $this;
    }

    /**
     * Get crossSelling
     *
     * @return \AppBundle\Entity\Product 
     */
    public function getCrossSelling()
    {
        return $this->crossSelling;
    }

    /**
     * Add aditional_options
     *
     * @param \AppBundle\Entity\ProductAditionalOptions $aditionalOptions
     * @return Product
     */
    public function addAditionalOption(\AppBundle\Entity\ProductAditionalOptions $aditionalOptions)
    {
        $this->aditional_options[] = $aditionalOptions;

        return $this;
    }

    /**
     * Remove aditional_options
     *
     * @param \AppBundle\Entity\ProductAditionalOptions $aditionalOptions
     */
    public function removeAditionalOption(\AppBundle\Entity\ProductAditionalOptions $aditionalOptions)
    {
        $this->aditional_options->removeElement($aditionalOptions);
    }

    /**
     * Get aditional_options
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAditionalOptions()
    {
        return $this->aditional_options;
    }
}
