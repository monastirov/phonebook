<?php

namespace Monastyryov\PhoneBookBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="Monastyryov\PhoneBookBundle\Repository\CityRepository")
 * @ORM\Table(name="city")
 */
class City
{
   /**
     * @var int
     * @Groups({"default"})
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @Groups({"default"})
     * @ORM\Column(type="string", length=100)
     */
    protected $title;

    /**
     * @var Street[]|ArrayCollection
     * @Groups({"cities"})
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
        $this->id = (int) $id;

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
        $this->title = (string) $title;

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
    public function setStreets(ArrayCollection $streets)
    {
        $this->streets = $streets;

        return $this;
    }
}