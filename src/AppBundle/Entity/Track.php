<?php
namespace AppBundle\Entity;
/**
 * Track
 */
class Track
{
    /**
     * @var integer
     */
    private $idUser;
    /**
     * @var string
     */
    private $idGenre;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $urlPicture;
    /**
     * @var string
     */
    private $compositor;
    /**
     * @var boolean
     */
    private $explicitContent;
    /**
     * @var string
     */
    private $downloadAuthorization;
    /**
     * @var \DateTime
     */
    private $transferredAt;
    /**
     * @var \DateTime
     */
    private $duration;
    /**
     * @var integer
     */
    private $nbListenings;
    /**
     * @var integer
     */
    private $nbDownloads;
    /**
     * @var integer
     */
    private $nbViews;
    /**
     * @var integer
     */
    private $nbLikes;
    /**
     * @var \DateTime
     */
    private $updatedAt;
    /**
     * @var \DateTime
     */
    private $createdAt;
    /**
     * @var integer
     */
    private $nbComments;
    /**
     * @var boolean
     */
    private $isValidated;
    /**
     * @var integer
     */
    private $id;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $genre;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $playlist;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $user;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->genre = new \Doctrine\Common\Collections\ArrayCollection();
        $this->playlist = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Track
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
        return $this;
    }
    /**
     * Get idUser
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
    /**
     * Set idGenre
     *
     * @param string $idGenre
     *
     * @return Track
     */
    public function setIdGenre($idGenre)
    {
        $this->idGenre = $idGenre;
        return $this;
    }
    /**
     * Get idGenre
     *
     * @return string
     */
    public function getIdGenre()
    {
        return $this->idGenre;
    }
    /**
     * Set type
     *
     * @param string $type
     *
     * @return Track
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
    /**
     * Add genre
     *
     * @param \AppBundle\Entity\Genre $genre
     *
     * @return Track
     */
    public function addGenre(\AppBundle\Entity\Genre $genre)
    {
        $this->genre[] = $genre;
        return $this;
    }
    /**
     * Remove genre
     *
     * @param \AppBundle\Entity\Genre $genre
     */
    public function removeGenre(\AppBundle\Entity\Genre $genre)
    {
        $this->genre->removeElement($genre);
    }
    /**
     * Get genre
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGenre()
    {
        return $this->genre;
    }
    /**
     * Add playlist
     *
     * @param \AppBundle\Entity\Playlist $playlist
     *
     * @return Track
     */
    public function addPlaylist(\AppBundle\Entity\Playlist $playlist)
    {
        $this->playlist[] = $playlist;
        return $this;
    }
    /**
     * Remove playlist
     *
     * @param \AppBundle\Entity\Playlist $playlist
     */
    public function removePlaylist(\AppBundle\Entity\Playlist $playlist)
    {
        $this->playlist->removeElement($playlist);
    }
    /**
     * Get playlist
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }
    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Track
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->user[] = $user;
        return $this;
    }
    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }
    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }
}