<?php

namespace SoundBuzzBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="track")
 */
class Track
{
    /**
     * @Assert\NotBlank(message="Please, upload the photo.")
     * @Assert\File(mimeTypes={ "audio/mp3", "audio/mpeg","audio/mp4" })
     */
    private $song;

    /**
     * @Assert\NotBlank(message="Please, upload the photo.")
     * @Assert\File(mimeTypes={ "image/jpg", "image/png","image/jpeg"})
     */
    private $songPicture;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    private $urlTrack;

    /**
     * @ORM\Column(type="string")
     */
    private $extension;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

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
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbListenings = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbDownloads = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbViews = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbLikes = 0;

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
     * @ORM\ManyToMany(targetEntity="Playlist", mappedBy="tracks")
     * @ORM\JoinTable(name="playlist_tracks")
     *
     */
    private $playlists;

    /**
     * Many Tracks have Many Genres.
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="tracks")
     * @ORM\JoinTable(name="track_genres")
     */
    private $genres;

    /**
     * A Track can be liked by many Users.
     * @ORM\ManyToMany(targetEntity="User", inversedBy="likedTracks")
     * @ORM\JoinTable(name="user_has_liked")
     */
    private $likedByUsers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->playlists = new ArrayCollection();
        $this->likedByUsers = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Set extension
     *
     * @param string $extension
     *
     * @return Track
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
        return $this;
    }
    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
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
     * Set urlTrack
     *
     * @param string $urlTrack
     *
     * @return Track
     */
    public function setUrlTrack($urlTrack)
    {
        $this->urlTrack = $urlTrack;
        return $this;
    }

    /**
     * Get urlTrack
     *
     * @return string
     */
    public function getUrlTrack()
    {
        return $this->urlTrack;
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
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPlaylists()
    {
        return $this->playlists;
    }

    /**
     * @param mixed $playlists
     */
    public function setPlaylists($playlists)
    {
        $this->playlists = $playlists;
    }

    /**
     * @return mixed
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param mixed $genres
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;
    }

    public function getSong() {
        return $this->song;
    }

    public function setSong($song) {
        $this->song = $song;
        return $this;
    }

    public function getSongPicture() {
        return $this->songPicture;
    }

    public function setSongPicture($songPicture) {
        $this->songPicture = $songPicture;
        return $this;
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * @return mixed
     */
    public function getLikedByUsers()
    {
        return $this->likedByUsers;
    }

//    /**
//     * @return Collection|User[]
//     */
//    public function getLikedByUsers(): Collection
//    {
//        return $this->likedByUsers;
//    }

    /**
     * @param mixed $likedByUsers
     * @return Track
     */
    public function setLikedByUsers($likedByUsers)
    {
        if (!$this->likedByUsers->contains($likedByUsers))
        {
            $this->likedByUsers[] = $likedByUsers;
        }

        return $this;
    }
}
