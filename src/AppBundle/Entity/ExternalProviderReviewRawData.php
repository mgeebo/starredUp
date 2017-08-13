<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExternalProviderReviewRawData
 *
 * @ORM\Table(name="external_provider_review_raw_data",indexes={@ORM\Index(name="product_upc", columns={"external_provider_id", "upc", "is_active"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExternalProviderReviewRawDataRepository") */
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
    private $externalReviewRawDataId;

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
     * @var string
     *
     * @ORM\Column(name="external_provider_data", type="text")
     */
    private $externalProviderData;

    /**
     * @var string
     *
     * @ORM\Column(name="upc", type="string", length=12)
     */
    private $upc;

    /**
     * Get id
     *
     * @return int
     */
    public function getExternalReviewRawDataId()
    {
        return $this->externalReviewRawDataId;
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
     * @return string
     */
    public function getExternalProviderData()
    {
        return $this->externalProviderData;
    }

    /**
     * @param string $externalProviderData
     */
    public function setExternalProviderData($externalProviderData)
    {
        $this->externalProviderData = $externalProviderData;
    }

    /**
     * @return string
     */
    public function getUpc()
    {
        return $this->upc;
    }

    /**
     * @param string $upc
     */
    public function setUpc($upc)
    {
        $this->upc = $upc;
    }


}

