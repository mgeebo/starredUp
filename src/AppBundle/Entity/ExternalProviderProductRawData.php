<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExternalProviderProductRawData
 *
 * @ORM\Table(name="external_provider_product_raw_data",indexes={@ORM\Index(name="product", columns={"external_provider_id", "upc"})})
 * @ORM\Entity
 */
class ExternalProviderProductRawData
{
    use BaseTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="external_product_raw_data_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $externalProductRawDataId;

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
    public function getexternalProductRawDataId()
    {
        return $this->externalProductRawDataId;
    }

    /**
     * Set Id
     *
     * @return int
     */
    public function setExternalProductRawDataId($externalProductRawDataId)
    {
        $this->externalProductRawDataId = $externalProductRawDataId;

        return $this;
    }

    /**
     * Get externalProductProviderId
     *
     * @return int
     */
    public function getExternalProductProviderId()
    {
        return $this->externalProviderId;
    }

    /**
     * Set externalProviderId
     *
     * @param string $externalProviderId
     *
     * @return string
     */
    public function setExternalProviderId($externalProviderId)
    {
        $this->externalProviderId = $externalProviderId;

        return $this;
    }

    /**
     * Set externalProviderData
     *
     * @param string $externalProviderData
     *
     * @return $this
     */
    public function setExternalProviderData($externalProviderData)
    {
        $this->externalProviderData = $externalProviderData;

        return $this;
    }

    /**
     * Get externalProviderData
     *
     * @return string
     */
    public function getExternalProviderData()
    {
        return $this->externalProviderData;
    }

    /**
     * set upc
     *
     * @param string $upc
     *
     * @return $this
     */
    public function setUpc($upc)
    {
        $this->upc = $upc;

        return $this;
    }

    /**
     * get upc
     * @return string
     */
    public function getUpc()
    {
        return $this->upc;
    }
}

