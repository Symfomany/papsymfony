<?php

namespace PaP\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Options
 *
 * @ORM\Table(name="options")
 * @ORM\Entity(repositoryClass="PaP\BackBundle\Repository\OptionsRepository")
 */
class Options
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;


    /**
     *
     * @ORM\ManyToMany(targetEntity="Announcement", mappedBy="options")
     */
    protected $announcement;


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
     * Set title
     *
     * @param string $title
     *
     * @return Options
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->options = new \Doctrine\Common\Collections\ArrayCollection();
    }

    

    /**
     * Add announcement
     *
     * @param \PaP\BackBundle\Entity\Announcement $announcement
     *
     * @return Options
     */
    public function addAnnouncement(\PaP\BackBundle\Entity\Announcement $announcement)
    {
        $this->announcement[] = $announcement;

        return $this;
    }

    /**
     * Remove announcement
     *
     * @param \PaP\BackBundle\Entity\Announcement $announcement
     */
    public function removeAnnouncement(\PaP\BackBundle\Entity\Announcement $announcement)
    {
        $this->announcement->removeElement($announcement);
    }

    /**
     * Get announcement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnouncement()
    {
        return $this->announcement;
    }
}
