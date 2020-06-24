<?php

namespace App\Repositories\Contracts;

// use App\Models\Addresses;

/**
 * Interface AddressesRepository.
 *
 * @package namespace App\Repositories;
 */
interface AddressesRepository extends BaseRepositoryInterface
{
    public function getContactAddresses($contactId);
    public function deleteContactAddresses($contactId);
    // protected $addresses;

    // public function __construct(Addresses $addresses)
    // {
    //     $this->addresses = $addresses;
    // }

    // public function find($id)
    // {
    //     return $this->addresses->find($id);
    // }

    // public function getAll()
    // {
    //     return $this->addresses->all();
    // }

    // public function store($data, $contactFk)
    // {
    //     $address = null;
    //     $address = new Addresses();

    //     $address->zip_code = $data['zip_code'];
    //     $address->street = $data['street'];
    //     $address->number = $data['number'];
    //     $address->neighborhood = $data['neighborhood'];
    //     if (isset($data['complement'])) {
    //         $address->complement = $data['complement'];
    //     }
    //     $address->city = $data['city'];
    //     $address->state = $data['state'];
    //     $address->contact_fk = $contactFk;
    //     $address->save();

    //     return $address;
    // }

    // public function getContactAddresses(int $contactId)
    // {
    //     $addresses = $this->addresses->where('contact_fk', '=', $contactId)->get();

    //     return $addresses;
    // }

    // public function delete($id)
    // {
    //     $addresses = $this->addresses->where([
    //         ["contact_fk", "=", $id]
    //     ])->delete();

    //     return $addresses;
    // }
}
