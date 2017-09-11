<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Swagger\Annotations as SWG;

/**
 * Product
 * @SWG\Definition(required={"productName", "upc"}, type="object")
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
{
    use BaseTrait;

    /**
     * @var int
     * @SWG\Property(example=1)
     * @ORM\Column(name="product_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $productId;

    /**
     * @var string
     * @SWG\Property(example="Amazon Echo")
     * @ORM\Column(name="product_name", type="string", length=255)
     */
    private $productName;

    /**
     * @var string
     * @SWG\Property(example="null")
     * @ORM\Column(name="product_description", type="text", nullable=true)
     */
    private $productDescription;

    /**
     * @var float
     * @SWG\Property(example="null")
     * @ORM\Column(name="product_rating", type="float", nullable=true)
     */
    private $productRating;

    /**
     * @var int
     * @SWG\Property(example="null")
     * @ORM\Column(name="review_count", type="integer", nullable=true)
     */
    private $reviewCount;

    /**
     * @var string
     * @SWG\Property(example="Amazon")
     * @ORM\Column(name="product_manufacturer", type="string", length=50, nullable=true)
     */
    private $productManufacturer;

    /**
     * @var string
     * @SWG\Property(example="848719071733")
     * @ORM\Column(name="upc", type="string", length=12, unique=true)
     */
    private $upc;

    /**
     * @var string
     * @SWG\Property(example="null")
     * @ORM\Column(name="product_image", type="string", length=255, nullable=true)
     */
    private $productImage;

    /**
     * @var string
     * @SWG\Property(example="Mobile Devices")
     * @ORM\Column(name="product_category", type="string", length=255, nullable=true)
     */
    private $productCategory;

    /**
     * @var string
     * @SWG\Property(example="Tablets")
     * @ORM\Column(name="product_subcategory", type="string", length=255, nullable=true)
     */
    private $productSubcategory;


    /**
     * @var boolean
     * @SWG\Property(example=1)
     * @ORM\Column(name="is_featured", type="boolean", nullable=true)
     */
    private $isFeatured;


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
     * @return string
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
     * @return string
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
     * @return string
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
     * @return string
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
     * @return $this
     */
    public function setReviewCount($reviewCount)
    {
        $this->reviewCount = $reviewCount;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductCategory()
    {
        return $this->productCategory;
    }

    /**
     * @param string $productCategory
     */
    public function setProductCategory($productCategory)
    {
        $this->productCategory = $productCategory;
    }

    /**
     * @return string
     */
    public function getProductSubcategory()
    {
        return $this->productSubcategory;
    }

    /**
     * @param string $productSubcategory
     */
    public function setProductSubcategory($productSubcategory)
    {
        $this->productSubcategory = $productSubcategory;
    }

    /**
     * @return bool
     */
    public function isFeatured()
    {
        return $this->isFeatured;
    }

    /**
     * @param bool $isFeatured
     */
    public function setIsFeatured($isFeatured)
    {
        $this->isFeatured = $isFeatured;
    }
}

