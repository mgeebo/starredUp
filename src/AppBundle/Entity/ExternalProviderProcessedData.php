<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExternalProviderProcessedData
 *
 * @ORM\Table(name="external_provider_processed_data")
 * @ORM\Entity
 */
class ExternalProviderProcessedData
{
    use BaseTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="external_processed_data_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="external_raw_data_id", type="integer")
     */
    private $externalRawDataId;

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
     * Set externalRawDataId
     *
     * @param integer $externalRawDataId
     *
     * @return ExternalProviderProcessedData
     */
    public function setExternalRawDataId($externalRawDataId)
    {
        $this->externalRawDataId = $externalRawDataId;

        return $this;
    }

    /**
     * Get externalRawDataId
     *
     * @return int
     */
    public function getExternalRawDataId()
    {
        return $this->externalRawDataId;
    }

    /**
     * Set externalProviderId
     *
     * @param integer $externalProviderId
     *
     * @return ExternalProviderProcessedData
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
     * @return ExternalProviderProcessedData
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
     * @return ExternalProviderProcessedData
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
     * @return ExternalProviderProcessedData
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

