<?php

namespace App\Repositories;

use App\Addresses;

/**
 * Interface AddressesRepository.
 *
 * @package namespace App\Repositories;
 */
class AddressesRepository
{
    protected $addresses;

    public function __construct(Addresses $addresses)
    {
        $this->addresses = $addresses;
    }

    public function find($id)
    {
        return $this->addresses->find($id);
    }

    public function getAll()
    {
        return $this->addresses->all();
    }

    /**
     * Creating or update resource.
     *
     * @return Address
     */
    public function save($data)
    {
        $address = null;
        $address = new Addresses();

        if (isset($data['address_id'])) {
            $address = Addresses::find($data['address_id']);
        }

        if (!$address) {
            return false;
        }

        $address->zip_code = $data['zip_code'];
        $address->street = $data['street'];
        $address->number = $data['number'];
        $address->neighborhood = $data['neighborhood'];
        if (isset($data['complement'])) {
            $address->complement = $data['complement'];
        }
        $address->city = $data['city'];
        $address->state = $data['state'];
        $address->contact_fk = $data['contact_fk'];
        $address->save();

        return $address;
    }

    public function getContactAddresses(int $contactId)
    {
        $addresses = $this->addresses->where('contact_fk', '=', $contactId)->get();

        return $addresses;
    }

    public function delete($id)
    {
        $addresses = $this->addresses->where([
            ["contact_fk", "=", $id]
        ])->delete();

        return $addresses;
    }
}
