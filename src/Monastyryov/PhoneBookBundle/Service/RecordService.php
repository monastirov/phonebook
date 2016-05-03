<?php

namespace Monastyryov\PhoneBookBundle\Service;

use Monastyryov\PhoneBookBundle\Entity\Record;
use Monastyryov\PhoneBookBundle\Exception\IdentificationNotFoundException;
use Monastyryov\PhoneBookBundle\Exception\RecordNotFoundException;
use Monastyryov\PhoneBookBundle\Exception\StreetNotFoundException;
use Monastyryov\PhoneBookBundle\Factory\RecordFactory;
use Monastyryov\PhoneBookBundle\Repository\RecordRepository;
use Monastyryov\PhoneBookBundle\Repository\StreetRepository;
use Monastyryov\PhoneBookBundle\Request\RecordRequest;
use Psr\Log\LoggerInterface;

class RecordService
{
    /** @var RecordRepository */
    protected $recordRepository;

    /** @var LoggerInterface */
    protected $logger;

    /** @var StreetRepository */
    protected $streetRepository;

    /** @var RecordFactory */
    protected $recordFactory;

    /** @var StreetService */
    protected $streetService;

    /**
     * RecordService constructor.
     * @param RecordRepository $recordRepository
     * @param StreetService $streetService
     * @param RecordFactory $recordFactory
     * @param LoggerInterface $logger
     * @internal param StreetRepository $streetRepository
     */
    public function __construct(
        RecordRepository $recordRepository,
        StreetService $streetService,
        RecordFactory $recordFactory,
        LoggerInterface $logger
    ) {
        $this->recordRepository = $recordRepository;
        $this->logger = $logger;
        $this->recordFactory = $recordFactory;
        $this->streetService = $streetService;
    }

    /**
     * @return Record[]
     */
    public function getAll()
    {
        return $this->recordRepository->findAll();
    }

    /**
     * @param RecordRequest $recordRequest
     * @throws IdentificationNotFoundException
     * @throws StreetNotFoundException
     */
    public function createRecordByRequest(RecordRequest $recordRequest)
    {
        $record = $this->recordFactory->createByRequest($recordRequest);
        $this->recordRepository->persist($record);
        $this->recordRepository->flush();
    }

    /**
     * @param RecordRequest $recordRequest
     * @throws IdentificationNotFoundException
     */
    public function updateRecord(RecordRequest $recordRequest)
    {
        $recordFound = $this->getRecordById($recordRequest->getId());
        $street = $this->streetService->getStreetById($recordRequest->getStreetId());
        $birthDatetime = new \DateTime();
        $birthDatetime->setTimestamp($recordRequest->getBirthTimestamp());

        $recordFound
            ->setBirthDatetime($birthDatetime)
            ->setName($recordRequest->getName())
            ->setPatronymic($recordRequest->getPatronymic())
            ->setPhoneNumber($recordRequest->getPhoneNumber())
            ->setStreet($street)
            ->setSurname($recordRequest->getSurname());

        $this->recordRepository->persist($recordFound);
        $this->recordRepository->flush();
    }

    /**
     * @param int $id
     */
    public function deleteRecord($id)
    {
        $record = $this->getRecordById($id);
        $this->recordRepository->remove($record);
        $this->recordRepository->flush();
    }

    /**
     * @param int $id
     * @return null|Record
     * @throws IdentificationNotFoundException
     * @throws RecordNotFoundException
     */
    protected function getRecordById($id)
    {
        if (null === $id) {
            $this->logger->info('Identification of record is invalid');
            throw new IdentificationNotFoundException();
        }

        $record = $this->recordRepository->find($id);
        if(null === $record) {
            $this->logger->info('Record not found', ['record_id' => $id]);
            throw new RecordNotFoundException();
        }

        return $record;
    }
}