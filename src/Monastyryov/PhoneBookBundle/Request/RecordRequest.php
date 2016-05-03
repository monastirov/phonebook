<?php

namespace Monastyryov\PhoneBookBundle\Request;

class RecordRequest
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $surname;

    /**
     * @var string
     */
    protected $patronymic;

    /**
     * @var int
     */
    protected $streetId;

    /**
     * @var int
     */
    protected $birthTimestamp;

    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }

    /**
     * @return mixed
     */
    public function getStreetId()
    {
        return $this->streetId;
    }

    /**
     * @return int
     */
    public function getBirthTimestamp()
    {
        return $this->birthTimestamp;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @param string $patronymic
     */
    public function setPatronymic($patronymic)
    {
        $this->patronymic = $patronymic;
    }

    /**
     * @param int $streetId
     */
    public function setStreetId($streetId)
    {
        $this->streetId = $streetId;
    }

    /**
     * @param int $birthTimestamp
     */
    public function setBirthTimestamp($birthTimestamp)
    {
        $this->birthTimestamp = $birthTimestamp;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
}