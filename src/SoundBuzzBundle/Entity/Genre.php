<?php

namespace SoundBuzzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="genre")
 */
class Genre
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
    private $name;

    /**
     * Many Genres have Many Tracks.
     * @ORM\ManyToMany(targetEntity="Track", mappedBy="genres")
     * @ORM\JoinTable(name="track_genres")
     */
    private $track;

    /**
     * Constructor
     */
    public function __construct()
    {

    }
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Genre
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
    public function getTrack()
    {
        return $this->track;
    }

    /**
     * @param mixed $track
     */
    public function setTrack($track)
    {
        $this->track = $track;
    }

    public function __toString()
    {
        return $this->getName();

    }
}
