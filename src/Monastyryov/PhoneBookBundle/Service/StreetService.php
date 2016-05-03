<?php

namespace Monastyryov\PhoneBookBundle\Service;

use Monastyryov\PhoneBookBundle\Entity\Street;
use Monastyryov\PhoneBookBundle\Exception\IdentificationNotFoundException;
use Monastyryov\PhoneBookBundle\Exception\StreetNotFoundException;
use Monastyryov\PhoneBookBundle\Repository\StreetRepository;
use Psr\Log\LoggerInterface;

class StreetService
{
    /** @var StreetRepository */
    protected $streetRepository;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * StreetService constructor.
     * @param StreetRepository $streetRepository
     * @param LoggerInterface $logger
     */
    public function __construct(StreetRepository $streetRepository, LoggerInterface $logger)
    {
        $this->streetRepository = $streetRepository;
        $this->logger = $logger;
    }

    /**
     * @param int $id
     * @return null|Street
     * @throws IdentificationNotFoundException
     * @throws StreetNotFoundException
     */
    public function getStreetById($id)
    {
        if (null === $id) {
            $this->logger->info('Identification of street is invalid');
            throw new IdentificationNotFoundException();
        }

        $street = $this->streetRepository->find($id);
        if(null === $street) {
            $this->logger->info('Street not found', ['street_id' => $id]);
            throw new StreetNotFoundException();
        }

        return $street;
    }
}