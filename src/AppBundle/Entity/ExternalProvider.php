<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * External Providers
 *
 * @ORM\Entity
 * @ORM\Table(name="external_providers")
 */
class ExternalProviders
{
    use BaseTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="external_provider_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $externalProviderId;

    /**
     * @var string
     *
     * @ORM\Column(name="provider_name", type="string", length=50)
     */
    private $providerName;

    /**
     * @var string
     *
     * @ORM\Column(name="provider_key", type="string", length=255)
     */
    private $providerKey;

    /**
     * Get id
     *
     * @return int
     */
    public function getExternalProviderId()
    {
        return $this->externalProviderId;
    }

    /**
     * Set providerName
     *
     * @param string $providerName
     *
     * @return ExternalProvider
     */
    public function setProviderName($providerName)
    {
        $this->providerName = $providerName;

        return $this;
    }

    /**
     * Get providerName
     *
     * @return string
     */
    public function getProviderName()
    {
        return $this->providerName;
    }

    /**
     * Set providerKey
     *
     * @param string $providerKey
     *
     * @return ExternalProvider
     */
    public function setProviderKey($providerKey)
    {
        $this->providerKey = $providerKey;

        return $this;
    }

    /**
     * Get providerKey
     *
     * @return string
     */
    public function getProviderKey()
    {
        return $this->providerKey;
    }

}
