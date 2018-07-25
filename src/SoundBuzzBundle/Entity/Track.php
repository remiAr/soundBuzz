<?php

namespace SoundBuzzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="track")
 */

class Track
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
    private $extention;
    
    /**
     * @ORM\Column(type="string")
     */
    private $description;
   
    /**
     * @ORM\Column(type="string")
     */
    private $urlPicture;
    
    /**
     * @ORM\Column(type="string")
     */
    private $compositor;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $explicitContent;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $downloadAuthorization;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $transferredAt;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $duration;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $nbListenings;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $nbDownloads;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $nbViews;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $nbLikes;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $nbComments;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $isValidated;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Many Tracks have Many Playlists.
     * @ORM\ManyToMany(targetEntity="Playlist", mappedBy="track")
     * @ORM\JoinTable(name="playlist_tracks")
     */
    private $playlist;

    /**
     * Many Tracks have Many Genres.
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="track")
     * @ORM\JoinTable(name="track_genres")
     */
    private $genre;

    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * Set extention
     *
     * @param string $extention
     *
     * @return Track
     */
    public function setExtention($extention)
    {
        $this->extention = $extention;
        return $this;
    }
    /**
     * Get extention
     *
     * @return string
     */
    public function getExtention()
    {
        return $this->extention;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Track
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Set urlPicture
     *
     * @param string $urlPicture
     *
     * @return Track
     */
    public function setUrlPicture($urlPicture)
    {
        $this->urlPicture = $urlPicture;
        return $this;
    }
    /**
     * Get urlPicture
     *
     * @return string
     */
    public function getUrlPicture()
    {
        return $this->urlPicture;
    }
    /**
     * Set compositor
     *
     * @param string $compositor
     *
     * @return Track
     */
    public function setCompositor($compositor)
    {
        $this->compositor = $compositor;
        return $this;
    }
    /**
     * Get compositor
     *
     * @return string
     */
    public function getCompositor()
    {
        return $this->compositor;
    }
    /**
     * Set explicitContent
     *
     * @param boolean $explicitContent
     *
     * @return Track
     */
    public function setExplicitContent($explicitContent)
    {
        $this->explicitContent = $explicitContent;
        return $this;
    }
    /**
     * Get explicitContent
     *
     * @return boolean
     */
    public function getExplicitContent()
    {
        return $this->explicitContent;
    }
    /**
     * Set downloadAuthorization
     *
     * @param string $downloadAuthorization
     *
     * @return Track
     */
    public function setDownloadAuthorization($downloadAuthorization)
    {
        $this->downloadAuthorization = $downloadAuthorization;
        return $this;
    }
    /**
     * Get downloadAuthorization
     *
     * @return string
     */
    public function getDownloadAuthorization()
    {
        return $this->downloadAuthorization;
    }
    /**
     * Set transferredAt
     *
     * @param \DateTime $transferredAt
     *
     * @return Track
     */
    public function setTransferredAt($transferredAt)
    {
        $this->transferredAt = $transferredAt;
        return $this;
    }
    /**
     * Get transferredAt
     *
     * @return \DateTime
     */
    public function getTransferredAt()
    {
        return $this->transferredAt;
    }
    /**
     * Set duration
     *
     * @param \DateTime $duration
     *
     * @return Track
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }
    /**
     * Get duration
     *
     * @return \DateTime
     */
    public function getDuration()
    {
        return $this->duration;
    }
    /**
     * Set nbListenings
     *
     * @param integer $nbListenings
     *
     * @return Track
     */
    public function setNbListenings($nbListenings)
    {
        $this->nbListenings = $nbListenings;
        return $this;
    }
    /**
     * Get nbListenings
     *
     * @return integer
     */
    public function getNbListenings()
    {
        return $this->nbListenings;
    }
    /**
     * Set nbDownloads
     *
     * @param integer $nbDownloads
     *
     * @return Track
     */
    public function setNbDownloads($nbDownloads)
    {
        $this->nbDownloads = $nbDownloads;
        return $this;
    }
    /**
     * Get nbDownloads
     *
     * @return integer
     */
    public function getNbDownloads()
    {
        return $this->nbDownloads;
    }
    /**
     * Set nbViews
     *
     * @param integer $nbViews
     *
     * @return Track
     */
    public function setNbViews($nbViews)
    {
        $this->nbViews = $nbViews;
        return $this;
    }
    /**
     * Get nbViews
     *
     * @return integer
     */
    public function getNbViews()
    {
        return $this->nbViews;
    }
    /**
     * Set nbLikes
     *
     * @param integer $nbLikes
     *
     * @return Track
     */
    public function setNbLikes($nbLikes)
    {
        $this->nbLikes = $nbLikes;
        return $this;
    }
    /**
     * Get nbLikes
     *
     * @return integer
     */
    public function getNbLikes()
    {
        return $this->nbLikes;
    }
    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Track
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Track
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * Set nbComments
     *
     * @param integer $nbComments
     *
     * @return Track
     */
    public function setNbComments($nbComments)
    {
        $this->nbComments = $nbComments;
        return $this;
    }
    /**
     * Get nbComments
     *
     * @return integer
     */
    public function getNbComments()
    {
        return $this->nbComments;
    }
    /**
     * Set isValidated
     *
     * @param boolean $isValidated
     *
     * @return Track
     */
    public function setIsValidated($isValidated)
    {
        $this->isValidated = $isValidated;
        return $this;
    }
    /**
     * Get isValidated
     *
     * @return boolean
     */
    public function getIsValidated()
    {
        return $this->isValidated;
    }
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
   
}