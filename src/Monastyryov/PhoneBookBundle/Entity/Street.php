<?php

namespace Monastyryov\PhoneBookBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Monastyryov\PhoneBookBundle\Repository\StreetRepository")
 * @ORM\Table(name="street")
 * @ExclusionPolicy("all")
 */
class Street
{
    /**
     * @var int
     * @Expose
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @Expose
     * @ORM\Column(type="string", length=200)
     */
    protected $title;

    /**
     * @var City
     * @Expose
     * @ORM\ManyToOne(targetEntity="Monastyryov\PhoneBookBundle\Entity\City", inversedBy="streets", fetch="EAGER")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
     */
    protected $city;

    /**
     * @var Record[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Monastyryov\PhoneBookBundle\Entity\Record", mappedBy="street")
     */
    protected $records;

    /**
     * Street constructor.
     */
    public function __construct()
    {
        $this->records = new ArrayCollection();
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
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param City $city
     * @return $this
     */
    public function setCity(City $city)
    {
        $this->city = $city;

        return $this;
    }
}