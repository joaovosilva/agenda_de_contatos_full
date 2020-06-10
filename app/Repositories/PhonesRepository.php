<?php

namespace App\Repositories;

use App\Phones;

/**
 * Interface PhonesRepository.
 *
 * @package namespace App\Repositories;
 */
class PhonesRepository
{
    protected $phones;

    public function __construct(Phones $phones)
    {
        $this->phones = $phones;
    }

    public function find($id)
    {
        return $this->phones->find($id);
    }

    public function getAll()
    {
        return $this->phones->all();
    }

    /**
     * Creating or update resource.
     *
     * @return Phone
     */
    public function save($data)
    {
        $phone = null;
        $phone = new Phones();

        if (isset($data['phone_id'])) {
            $phone = $this->phones->find($data['phone_id']);
        }

        if (!$phone) {
            return false;
        }

        $phone->phone = $data['phone'];
        $phone->type = $data['type'];
        $phone->contact_fk = $data['contact_fk'];
        $phone->save();

        return $phone;
    }

    public function getContactPhones(int $contactId)
    {
        $phones = $this->phones->where('contact_fk', '=', $contactId)->get();

        return $phones;
    }

    public function delete($id)
    {
        $phone = $this->phones->where([
            ["contact_fk", "=", $id]
        ])->delete();
        
        return $phone;
    }
}
