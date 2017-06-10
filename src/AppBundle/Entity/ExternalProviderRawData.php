<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExternalProviderRawData
 *
 * @ORM\Table(name="external_provider_raw_data")
 * @ORM\Entity
 */
class ExternalProviderRawData
{
    use BaseTrait;
    /**
     * @var int
     *
     * @ORM\Column(name="external_raw_data_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="external_provider_id", type="integer")
     */
    private $externalProviderId;

    /**
     * @var string
     *
     * @ORM\Column(name="external_provider_data", type="string", length=255)
     */
    private $externalProviderData;

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
     * Set externalProviderId
     *
     * @param integer $externalProviderId
     *
     * @return ExternalProviderRawData
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
     * Set externalProviderData
     *
     * @param string $externalProviderData
     *
     * @return ExternalProviderRawData
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

}

