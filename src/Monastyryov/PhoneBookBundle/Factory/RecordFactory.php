<?php

namespace Monastyryov\PhoneBookBundle\Factory;

use Monastyryov\PhoneBookBundle\Entity\Record;
use Monastyryov\PhoneBookBundle\Exception\IdentificationNotFoundException;
use Monastyryov\PhoneBookBundle\Exception\StreetNotFoundException;
use Monastyryov\PhoneBookBundle\Request\RecordRequest;
use Monastyryov\PhoneBookBundle\Service\StreetService;
use Psr\Log\LoggerInterface;

class RecordFactory
{
    /** @var StreetService */
    protected $streetService;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * RecordFactory constructor.
     * @param StreetService $streetService
     * @param LoggerInterface $logger
     */
    public function __construct(StreetService $streetService, LoggerInterface $logger)
    {
        $this->streetService = $streetService;
        $this->logger = $logger;
    }

    /**
     * @param RecordRequest $recordRequest
     * @return Record
     * @throws IdentificationNotFoundException
     * @throws StreetNotFoundException
     */
    public function createByRequest(RecordRequest $recordRequest)
    {
        $street = $this->streetService->getStreetById($recordRequest->getStreetId());
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
}