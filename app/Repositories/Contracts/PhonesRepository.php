<?php

namespace App\Repositories\Contracts;

// use App\Models\Phones;

/**
 * Interface PhonesRepository.
 *
 * @package namespace App\Repositories;
 */
interface PhonesRepository extends BaseRepositoryInterface
{
    public function getContactPhones($contactId);
    public function deleteContactPhones($contactId);
    // protected $phones;

    // public function __construct(Phones $phones)
    // {
    //     $this->phones = $phones;
    // }

    // public function find($id)
    // {
    //     return $this->phones->find($id);
    // }

    // public function getAll()
    // {
    //     return $this->phones->all();
    // }

    // public function store($data, $contactFk)
    // {
    //     $phone = null;
    //     $phone = new Phones();

    //     $phone->phone = $data['phone'];
    //     $phone->type = $data['type'];
    //     $phone->contact_fk = $contactFk;
    //     $phone->save();

    //     return $phone;
    // }

    // public function getContactPhones(int $contactId)
    // {
    //     $phones = $this->phones->where('contact_fk', '=', $contactId)->get();

    //     return $phones;
    // }

    // public function delete($id)
    // {
    //     $phone = $this->phones->where([
    //         ["contact_fk", "=", $id]
    //     ])->delete();
        
    //     return $phone;
    // }
}
