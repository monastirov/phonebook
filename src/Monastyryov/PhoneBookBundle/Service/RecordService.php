<?php

namespace Monastyryov\PhoneBookBundle\Service;

use Monastyryov\PhoneBookBundle\Repository\RecordRepository;

class RecordService
{
    /** @var RecordRepository */
    protected $recordRepository;

    /**
     * RecordService constructor.
     * @param RecordRepository $recordRepository
     */
    public function __construct(RecordRepository $recordRepository)
    {
        $this->recordRepository = $recordRepository;
    }
}