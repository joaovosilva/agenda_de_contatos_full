<?php

namespace App\Repositories;

use App\Models\Contacts;

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

    public function store($request, $userFk)
    {
        $contact = null;
        $contact = new Contacts();

        $contact->name = $request->name;
        $contact->user_fk = $userFk;
        $contact->company = $request->company;
        $contact->role = $request->role;
        $contact->save();

        return $contact;
    }

    public function update($request, $contactId, $userFk)
    {
        $contact = $this->contacts->find($contactId);

        if (!$contact) {
            return back()->with('error', 'Contato não encontrado');
        }

        $contact->name = $request->name;
        $contact->user_fk = $userFk;
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
