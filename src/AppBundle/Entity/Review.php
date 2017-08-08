<?php

//<editor-fold desc="Description">...//</editor-fold>

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Swagger\Annotations as SWG;

/**
 * Review
 * @SWG\Definition(required={"reviewId"}, type="object")
 * @ORM\Table(name="reviews")
 * @ORM\Entity
 */
class Review
{
    //<editor-fold desc="Variables">

    use BaseTrait;

    /**
     * @var int
     * @SWG\Property(example=1)
     * @ORM\Column(name="review_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $reviewId;

    /**
     * @var int
     * @SWG\Property(example=1)
     * @ORM\Column(name="product_id", type="integer")
     */
    private $productId;

    /**
     * @var int
     * @SWG\Property(example=1)
     * @ORM\Column(name="member_id", type="integer")
     */
    private $memberId;

    /**
     * @var int
     * @SWG\Property(example=1)
     * @ORM\Column(name="original_member_id", type="integer")
     */
    private $originalMemberId;

    /**
     * @var string
     * @SWG\Property(example="Very Good")
     * @ORM\Column(name="review_title", type="string", length=255)
     */
    private $reviewTitle;

    /**
     * @var string
     * @SWG\Property(example="Very Good")
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var double
     * @SWG\Property(example=4.5)
     * @ORM\Column(name="rating", type="float")
     */
    private $rating;

    //</editor-fold>

    //<editor-fold desc="Getters & Setters">

    /**
     * @return int
     */
    public function getReviewId()
    {
        return $this->reviewId;
    }

    /**
     * @param int $reviewId
     */
    public function setReviewId($reviewId)
    {
        $this->reviewId = $reviewId;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getMemberId()
    {
        return $this->memberId;
    }

    /**
     * @param int $memberId
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;
    }

    /**
     * @return int
     */
    public function getOriginalMemberId()
    {
        return $this->originalMemberId;
    }

    /**
     * @param int $originalMemberId
     */
    public function setOriginalMemberId($originalMemberId)
    {
        $this->originalMemberId = $originalMemberId;
    }

    /**
     * @return string
     */
    public function getReviewTitle()
    {
        return $this->reviewTitle;
    }

    /**
     * @param string $reviewTitle
     */
    public function setReviewTitle($reviewTitle)
    {
        $this->reviewTitle = $reviewTitle;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param float $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    //</editor-fold>

    //<editor-fold desc="Methods">

    /*
     * Will calculate the Rating based on an id or a number
     */
    public static function CalculateRating()
    {}

    //</editor-fold>
}

