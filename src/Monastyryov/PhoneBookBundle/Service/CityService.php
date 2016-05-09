<?php

namespace Monastyryov\PhoneBookBundle\Service;

use Monastyryov\PhoneBookBundle\Entity\City;
use Monastyryov\PhoneBookBundle\Repository\CityRepository;

class CityService
{
    /** @var CityRepository */
    protected $cityRepository;

    /**
     * CityService constructor.
     * @param CityRepository $cityRepository
     */
    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * @return City[]
     */
    public function getAll()
    {
        return $this->cityRepository->findAll();
    }
}