<?php


namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
    * @ORM\Column(type="string")
    */
    private $lastName;
    
    /**
    * @ORM\Column(type="string")
    */
    private $avatarUrl;
    
    /**
    * @ORM\Column(type="boolean")
    */
    private $isActivated;
    
    /**
    * @ORM\Column(type="datetime")
    */
    private $createdAt;

    /**
    * @ORM\OneToMany(targetEntity="User", mappedBy="user")
    */
   private $tracks;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="playlist")
     */
    private $playlist;

    /**
    * @ORM\OneToMany(targetEntity="User", mappedBy="userComment")
    */
   private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
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
     * @return User
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
     * Set avatarUrl
     *
     * @param string $avatarUrl
     *
     * @return User
     */
    public function setAvatarUrl($avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;
        return $this;
    }
    /**
     * Get avatarUrl
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }
    /**
     * Set isActivated
     *
     * @param boolean $isActivated
     *
     * @return User
     */
    public function setIsActivated($isActivated)
    {
        $this->isActivated = $isActivated;
        return $this;
    }
    /**
     * Get createdAt
     *
     * @return boolean
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * Set createdAt
     *
     * @param boolean $createdAt
     *
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * Get isActivated
     *
     * @return boolean
     */
    public function getIsActivated()
    {
        return $this->isActivated;
    }
   
    
    
}