<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Swagger\Annotations as SWG;

/**
 * Clients
 * @SWG\Definition(required={"client_name", "client_member_name", "client_password"}, type="object")
 * @ORM\Table(name="clients")
 * @ORM\Entity
 */
class Client
{
    use BaseTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="client_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $clientId;

    /**
     * @var string
     *
     * @ORM\Column(name="client_name", type="string", length=20, unique=true)
     */
    private $clientName;

    /**
     * @var string
     *
     * @ORM\Column(name="client_member_name", type="string", length=20)
     */
    private $clientMemberName;

    /**
     * @var string
     *
     * @ORM\Column(name="client_password", type="string", length=20)
     */
    private $clientPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="client_image", type="string", length=255)
     */
    private $clientImage;

    /**
     * Get id
     *
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set clientName
     *
     * @param string $clientName
     *
     * @return Client
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;

        return $this;
    }

    /**
     * Get clientName
     *
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * Set clientMemberName
     *
     * @param string $clientMemberName
     *
     * @return Client
     */
    public function setClientMemberName($clientMemberName)
    {
        $this->clientMemberName = $clientMemberName;

        return $this;
    }

    /**
     * Get clientMemberName
     *
     * @return string
     */
    public function getClientMemberName()
    {
        return $this->clientMemberName;
    }

    /**
     * Set clientPassword
     *
     * @param string $clientPassword
     *
     * @return Client
     */
    public function setClientPassword($clientPassword)
    {
        $this->clientPassword = $clientPassword;

        return $this;
    }

    /**
     * Get clientPassword
     *
     * @return string
     */
    public function getClientPassword()
    {
        return $this->clientPassword;
    }

    /**
     * Set clientImage
     *
     * @param string $clientImage
     *
     * @return Client
     */
    public function setClientImage($clientImage)
    {
        $this->clientImage = $clientImage;

        return $this;
    }

    /**
     * Get clientImage
     *
     * @return string
     */
    public function getClientImage()
    {
        return $this->clientImage;
    }
}