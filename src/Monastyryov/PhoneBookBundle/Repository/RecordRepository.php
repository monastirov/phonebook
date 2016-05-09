<?php

namespace Monastyryov\PhoneBookBundle\Repository;

use Monastyryov\PhoneBookBundle\Entity\Record;

class RecordRepository extends BaseRepository
{
    /**
     * @return Record[]
     */
    public function findAll()
    {
        return $this->findBy([], ['id' => 'ASC']);
    }
}
