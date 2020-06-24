<?php

namespace App\Repositories\Contracts;

/**
 * Interface ContactsRepository.
 *
 * @package namespace App\Repositories;
 */
interface ContactsRepository extends BaseRepositoryInterface
{
    public function getUserContacts($userId);
}
