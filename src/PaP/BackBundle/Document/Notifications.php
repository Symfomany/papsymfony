<?php
namespace PaP\BackBundle\Document;


use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document(repositoryClass="PaP\BackBundle\Repository\NotificationsRepository")
 * @MongoDB\HasLifecycleCallbacks
 */
class Notifications
{
    /**
     * @MongoDB\Id
     */
    public $id;

    /**
     * @MongoDB\int
     */
    public $aid;


    /**
     * @MongoDB\String
     */
    public $criticity;

    /**
     * @MongoDB\String
     */
    public $object;

    /**
     * @MongoDB\String
     */
    public $title;

    /**
     * @MongoDB\Date
     */
    public $date;

    /**
     * @MongoDB\Boolean
     */
    public $state;

    /**
     * @MongoDB\String
     */
    public $author;


    public function __construct(){

        $this->date = new \DateTime('now');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAid()
    {
        return $this->aid;
    }

    /**
     * @param mixed $aid
     */
    public function setAid($aid)
    {
        $this->aid = $aid;
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
     * @return mixed
     */
    public function getCriticity()
    {
        return $this->criticity;
    }

    /**
     * @param mixed $criticity
     */
    public function setCriticity($criticity)
    {
        $this->criticity = $criticity;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param mixed $object
     */
    public function setObject($object)
    {
        $this->object = $object;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }


    /**
     * @MongoDB\PreUpdate
     * @MongoDB\PrePersist
     */
    public function setTimeModValue() {
        $this->date = new \DateTime('now');
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

}
?>