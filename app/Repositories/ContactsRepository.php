<?php

namespace App\Repositories;

use App\Contacts;

/**
 * Interface ContactsRepository.
 *
 * @package namespace App\Repositories;
 */
class ContactsRepository
{
    protected $contacts;

    public function __construct(Contacts $contacts)
    {
        $this->contacts = $contacts;
    }

    public function find($id)
    {
        return $this->contacts->find($id);
    }

    public function getAll()
    {
        return $this->contacts->all();
    }

    /**
     * Creating or update resource.
     *
     * @return Contact
     */
    public function save($request)
    {
        $contact = null;
        $contact = new Contacts();

        if ($request->contact_id != null && $request->contact_id != "") {
            $contact = $this->contacts->find($request->id);
        }

        if (!$contact) {
            return false;
        }

        $contact->name = $request->name;
        $contact->user_fk = $request->user_fk;
        $contact->company = $request->company;
        $contact->role = $request->role;
        $contact->save();

        return $contact;
    }

    public function getUserContacts($userId)
    {
        $contacts = $this->contacts->where('user_fk', '=', $userId)->get();

        return $contacts;
    }

    public function delete($contact)
    {
        $contact = $contact->delete();

        return $contact;
    }
}
