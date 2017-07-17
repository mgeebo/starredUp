<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExternalProviderReviewRawData
 *
 * @ORM\Table(name="external_provider_review_raw_data")
 * @ORM\Entity
 */
class ExternalProviderReviewRawData
{
    use BaseTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="external_review_raw_data_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="external_raw_product_data_id", type="integer")
     */
    private $externalRawProductDataId;

    /**
     * @var int
     *
     * @ORM\Column(name="external_provider_id", type="integer")
     */
    private $externalProviderId;

    /**
     * @var int
     *
     * @ORM\Column(name="product_id", type="integer")
     */
    private $productId;

    /**
     * @var string
     *
     * @ORM\Column(name="review_description", type="string", length=255, nullable=true)
     */
    private $reviewDescription;

    /**
     * @var int
     *
     * @ORM\Column(name="review_rating", type="integer", nullable=true)
     */
    private $reviewRating;


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
     * Set externalRawProductDataId
     *
     * @param integer $externalRawProductDataId
     *
     * @return string
     */
    public function setExternalProductRawDataId($externalRawProductDataId)
    {
        $this->externalRawProductDataId = $externalRawProductDataId;

        return $this;
    }

    /**
     * Get externalRawProductDataId
     *
     * @return int
     */
    public function getExternalRawProductDataId()
    {
        return $this->externalRawProductDataId;
    }

    /**
     * Set externalProviderId
     *
     * @param integer $externalProviderId
     *
     * @return string
     */
    public function setExternalProviderId($externalProviderId)
    {
        $this->externalProviderId = $externalProviderId;

        return $this;
    }

    /**
     * Get externalProviderId
     *
     * @return int
     */
    public function getExternalProviderId()
    {
        return $this->externalProviderId;
    }

    /**
     * Set productId
     *
     * @param integer $productId
     *
     * @return string
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set reviewDescription
     *
     * @param string $reviewDescription
     *
     * @return string
     */
    public function setReviewDescription($reviewDescription)
    {
        $this->reviewDescription = $reviewDescription;

        return $this;
    }

    /**
     * Get reviewDescription
     *
     * @return string
     */
    public function getReviewDescription()
    {
        return $this->reviewDescription;
    }

    /**
     * Set reviewRating
     *
     * @param integer $reviewRating
     *
     * @return string
     */
    public function setReviewRating($reviewRating)
    {
        $this->reviewRating = $reviewRating;

        return $this;
    }

    /**
     * Get reviewRating
     *
     * @return int
     */
    public function getReviewRating()
    {
        return $this->reviewRating;
    }
}

