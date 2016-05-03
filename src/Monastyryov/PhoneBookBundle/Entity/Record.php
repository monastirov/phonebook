<?php

namespace Monastyryov\PhoneBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ORM\Entity(repositoryClass="Monastyryov\PhoneBookBundle\Repository\RecordRepository")
 * @ORM\Table(name="record")
 * @ExclusionPolicy("all")
 */
class Record
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
     * @ORM\Column(type="string", length=200, nullable=false)
     */
    protected $name;

    /**
     * @var string
     * @Expose
     * @ORM\Column(type="string", length=200, nullable=false)
     */
    protected $surname;

    /**
     * @var string
     * @Expose
     * @ORM\Column(type="string", length=200, nullable=false)
     */
    protected $patronymic;

    /**
     * @var Street
     * @Expose
     * @ORM\ManyToOne(targetEntity="Monastyryov\PhoneBookBundle\Entity\Street", inversedBy="records", fetch="EAGER")
     * @ORM\JoinColumn(name="street_id", referencedColumnName="id", nullable=false)
     */
    protected $street;

    /**
     * @var \DateTime
     * @Expose
     * @Serializer\Type("DateTime<'U'>")
     * @Serializer\SerializedName("birth_timestamp")
     * @ORM\Column(name="birth_datetime", type="datetime", nullable=false)
     */
    protected $birthDatetime;

    /**
     * @var string
     * @Expose
     * @ORM\Column(type="string", length=15, nullable=false)
     */
    protected $phoneNumber;

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return $this
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = (string) $phoneNumber;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDatetime()
    {
        return $this->birthDatetime;
    }

    /**
     * @param \DateTime $birthDatetime
     * @return $this
     */
    public function setBirthDatetime(\DateTime $birthDatetime)
    {
        $this->birthDatetime = $birthDatetime;

        return $this;
    }

    /**
     * @return Street
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param Street $street
     * @return $this
     */
    public function setStreet(Street $street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }

    /**
     * @param string $patronymic
     * @return $this
     */
    public function setPatronymic($patronymic)
    {
        $this->patronymic = (string) $patronymic;

        return $this;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return $this
     */
    public function setSurname($surname)
    {
        $this->surname = (string) $surname;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = (string) $name;

        return $this;
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
}