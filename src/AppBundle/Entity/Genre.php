<?php
namespace AppBundle\Entity;
/**
 * Genre
 */
class Genre
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var integer
     */
    private $id;
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
     * Add track
     *
     * @param \AppBundle\Entity\Track $track
     *
     * @return Genre
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