<?php

//<editor-fold desc="Description">...//</editor-fold>

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 *
 * @ORM\Table(name="reviews",indexes={
 *     @ORM\Index(name="product_member", columns={"product_id", "member_id"}),
 *     @ORM\Index(name="product_original_member", columns={"product_id", "original_member_name"})
 *  }
 * )
 * @ORM\Entity
 */
class Review
{
    use BaseTrait;

    //<editor-fold desc="Variables">

    /**
     * @var int
     *
     * @ORM\Column(name="review_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $reviewId;

    /**
     * @var int
     *
     * @ORM\Column(name="product_id", type="integer")
     */
    private $productId;

    /**
     * @var int
     *
     * @ORM\Column(name="member_id", type="integer")
     */
    private $memberId;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var double
     * @ORM\Column(name="rating", type="float")
     */
    private $rating;

    /**
     * @var string
     * @ORM\Column(name="review_title", type="string", length=20)
     */
    private $reviewTitle;

    /**
     * @var string
     * @ORM\Column(name="original_member_name", type="string", length=20)
     */
    private $originalMemberName;

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
        $this->memberIdId = $memberId;
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
    public function getOriginalMemberName()
    {
        return $this->originalMemberName;
    }

    /**
     * @param string $originalMemberName
     */
    public function setOriginalMemberName($originalMemberName)
    {
        $this->originalMemberName = $originalMemberName;
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

