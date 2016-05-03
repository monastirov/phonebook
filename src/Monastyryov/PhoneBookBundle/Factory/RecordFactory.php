<?php

namespace Monastyryov\PhoneBookBundle\Factory;

use Monastyryov\PhoneBookBundle\Entity\Record;
use Monastyryov\PhoneBookBundle\Entity\Street;
use Monastyryov\PhoneBookBundle\Exception\IdentificationNotFoundException;
use Monastyryov\PhoneBookBundle\Exception\StreetNotFoundException;
use Monastyryov\PhoneBookBundle\Repository\StreetRepository;
use Monastyryov\PhoneBookBundle\Request\RecordRequest;
use Psr\Log\LoggerInterface;

class RecordFactory
{
    /** @var StreetRepository */
    protected $streetRepository;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * RecordFactory constructor.
     * @param StreetRepository $streetRepository
     * @param LoggerInterface $logger
     */
    public function __construct(StreetRepository $streetRepository, LoggerInterface $logger)
    {
        $this->streetRepository = $streetRepository;
        $this->logger = $logger;
    }

    /**
     * @param RecordRequest $recordRequest
     * @return $this
     * @throws IdentificationNotFoundException
     * @throws StreetNotFoundException
     */
    public function createByRequest(RecordRequest $recordRequest)
    {
        $street = $this->getStreetById($recordRequest->getStreetId());
        $birthTimestamp = $recordRequest->getBirthTimestamp();
        $birthDatetime = new \DateTime();
        $birthDatetime->setTimestamp($birthTimestamp);

        return (new Record())
            ->setStreet($street)
            ->setSurname($recordRequest->getSurname())
            ->setBirthDatetime($birthDatetime)
            ->setPhoneNumber($recordRequest->getPhoneNumber())
            ->setPatronymic($recordRequest->getPatronymic())
            ->setId($recordRequest->getId())
            ->setName($recordRequest->getName());
    }

    /**
     * @param $id
     * @return null|Street
     * @throws IdentificationNotFoundException
     * @throws StreetNotFoundException
     */
    protected function getStreetById($id)
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