<?php

namespace Monastyryov\PhoneBookBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Monastyryov\PhoneBookBundle\Repository\CityRepository")
 * @ORM\Table(name="city")
 */
class City
{
   /**
     * @var int
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    protected $title;

    /**
     * @var Street[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Monastyryov\PhoneBookBundle\Entity\Street", mappedBy="city")
     */
    protected $streets;

    /**
     * City constructor.
     */
    public function __construct()
    {
        $this->streets = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return ArrayCollection|Street[]
     */
    public function getStreets()
    {
        return $this->streets;
    }

    /**
     * @param ArrayCollection|Street[] $streets
     * @return $this
     */
    public function setStreets($streets)
    {
        $this->streets = $streets;

        return $this;
    }
}