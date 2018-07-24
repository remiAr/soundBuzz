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
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;
    /**
     * @var string
     */
    private $avatarUrl;
    /**
     * @var boolean
     */
    private $isActivated;
    
    /**
     * @var \AppBundle\Entity\Comments
     */
    private $comments;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $track;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->track = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get isActivated
     *
     * @return boolean
     */
    public function getIsActivated()
    {
        return $this->isActivated;
    }
   
    /**
     * Set comments
     *
     * @param \AppBundle\Entity\Comments $comments
     *
     * @return User
     */
    public function setComments(\AppBundle\Entity\Comments $comments = null)
    {
        $this->comments = $comments;
        return $this;
    }
    /**
     * Get comments
     *
     * @return \AppBundle\Entity\Comments
     */
    public function getComments()
    {
        return $this->comments;
    }
    /**
     * Add track
     *
     * @param \AppBundle\Entity\Track $track
     *
     * @return User
     */
    public function addTrack(\AppBundle\Entity\Track $track)
    {
        $this->track[] = $track;
        return $this;
    }
    /**
     * Remove track
     *
     * @param \AppBundle\Entity\Track $track
     */
    public function removeTrack(\AppBundle\Entity\Track $track)
    {
        $this->track->removeElement($track);
    }
    /**
     * Get track
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrack()
    {
        return $this->track;
    }
}