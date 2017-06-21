<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Products
 *
 * @ORM\Table(name="products")
 * @ORM\Entity
 */
class Product
{
    use BaseTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="product_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $productId;

    /**
     * @var string
     *
     * @ORM\Column(name="product_name", type="string", length=255)
     */
    private $productName;

    /**
     * @var string
     *
     * @ORM\Column(name="product_description", type="text", nullable=true)
     */
    private $productDescription;

    /**
     * @var float
     *
     * @ORM\Column(name="product_rating", type="float")
     */
    private $productRating;

    /**
     * @var int
     *
     * @ORM\Column(name="review_count", type="integer")
     */
    private $reviewCount;

    /**
     * @var string
     *
     * @ORM\Column(name="product_manufacturer", type="string", length=50, nullable=true)
     */
    private $productManufacturer;

    /**
     * @var string
     *
     * @ORM\Column(name="upc", type="string", length=12, unique=true)
     */
    private $upc;

    /**
     * @var string
     *
     * @ORM\Column(name="product_image", type="string", length=255, nullable=true)
     */
    private $productImage;

    /**
     * Get id
     *
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set productName
     *
     * @param string $productName
     *
     * @return Products
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set productDescription
     *
     * @param string $productDescription
     *
     * @return Products
     */
    public function setProductDescription($productDescription)
    {
        $this->productDescription = $productDescription;

        return $this;
    }

    /**
     * Get productDescription
     *
     * @return string
     */
    public function getProductDescription()
    {
        return $this->productDescription;
    }

    /**
     * Set productRating
     *
     * @param float $productRating
     *
     * @return Products
     */
    public function setProductRating($productRating)
    {
        $this->productRating = $productRating;

        return $this;
    }

    /**
     * Get productRating
     *
     * @return float
     */
    public function getProductRating()
    {
        return $this->productRating;
    }

    /**
     * Set productManufacturer
     *
     * @param string $productManufacturer
     *
     * @return Products
     */
    public function setProductManufacturer($productManufacturer)
    {
        $this->productManufacturer = $productManufacturer;

        return $this;
    }

    /**
     * Get productManufacturer
     *
     * @return string
     */
    public function getProductManufacturer()
    {
        return $this->productManufacturer;
    }

    /**
     * Set productSku
     *
     * @param string $upc
     *
     * @return Products
     */
    public function setUpc($upc)
    {
        $this->upc = $upc;

        return $this;
    }

    /**
     * Get upc
     *
     * @return string
     */
    public function getUpc()
    {
        return $this->upc;
    }

    /**
     * Set productImage
     *
     * @param string $productImage
     *
     * @return Products
     */
    public function setProductImage($productImage)
    {
        $this->productImage = $productImage;

        return $this;
    }

    /**
     * Get productImage
     *
     * @return string
     */
    public function getProductImage()
    {
        return $this->productImage;
    }

    /**
     * Get reviewCount
     * @return int
     */
    public function getReviewCount()
    {
        return $this->reviewCount;
    }

    /**
     * Set reviewCount
     *
     * @param int $reviewCount
     *
     * return $this
     */
    public function setReviewCount($reviewCount)
    {
        $this->reviewCount = $reviewCount;

        return $this;
    }
}

