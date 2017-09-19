<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Swagger\Annotations as SWG;
use Ma27\ApiKeyAuthenticationBundle\Annotation as Auth;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Members
 * @SWG\Definition(required={"memberName", "firstName", "lastName", "email", "password", "dob"}, type="object")
 * @ORM\Table(name="members")
 * @ORM\Entity
 */
class Member implements UserInterface
{
    //<editor-fold desc="Variables">
    use BaseTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="member_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $memberId;

    /**
     * @var string
     *
     * @ORM\Column(name="member_name", type="string", length=20, unique=true)
     */
    private $memberName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=20)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=20)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Auth\Login
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Auth\Password
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dob", type="date")
     */
    private $dob;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_admin", type="boolean")
     */
    private $isAdmin;

    /**
     * @ORM\Column(name="api_key", type="string", unique=true, nullable=true)
     * @Auth\ApiKey
     */
    private $apiKey;
    //</editor-fold>

    //<editor-fold desc="Getters & Setters">
    /**
     * Get id
     *
     * @return int
     */
    public function getMemberId()
    {
        return $this->memberId;
    }

    /**
     * Set memberName
     *
     * @param string $memberName
     *
     * @return Member
     */
    public function setMemberName($memberName)
    {
        $this->memberName = $memberName;

        return $this;
    }

    /**
     * Get memberName
     *
     * @return string
     */
    public function getMemberName()
    {
        return $this->memberName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Member
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Member
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Member
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Member
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set dob
     *
     * @param \DateTime $dob
     *
     * @return Member
     */
    public function setDOB($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return \DateTime
     */
    public function getDOB()
    {
        return $this->dob;
    }

    /**
     * Set isAdmin
     *
     * @param boolean $isAdmin
     *
     * @return Member
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get isAdmin
     *
     * @return bool
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set apiKey
     *
     * @param string $apiKey
     *
     * @return Member
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get apiKey
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }
    //</editor-fold>

    //<editor-fold desc="User Interface Methods">
    public function getUsername()
    {
        $this->getEmail();
    }

    public function getRoles(){}

    public function getSalt(){}

    public function eraseCredentials(){}
    //</editor-fold>
}

