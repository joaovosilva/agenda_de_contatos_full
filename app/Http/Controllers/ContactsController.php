<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Http\Requests\ContactsRequest;
use App\Services\AddressesService;
use App\Services\ContactsService;
use App\Services\EmailService;
use App\Services\PhonesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    protected $contactsService;
    protected $phonesService;
    protected $addressesService;
    protected $emailService;

    public function __construct(
        ContactsService $contactsService,
        PhonesService $phonesService,
        AddressesService $addressesService,
        EmailService $emailService
    ) {
        $this->contactsService = $contactsService;
        $this->phonesService = $phonesService;
        $this->addressesService = $addressesService;
        $this->emailService = $emailService;
        $this->middleware('auth');
    }



    public function show($id, $returnView = false)
    {
        $contact = $this->contactsService->find($id);

        if (!$contact) {
            return ResponseService::returnApi(false, null, "Contato não encontrado");
        }

        $phones = $this->phonesService->searchPhones($contact->contact_id);

        $addresses = $this->addressesService->searchAddresses($contact->contact_id);

        $contact->phones = $phones;
        $contact->addresses = $addresses;

        if (!$returnView) {
            return view('contact-form', compact('contact'));
        }

        return $contact;
    }

    public function index()
    {
        $id = Auth::id();
        $contacts = $this->contactsService->searchContacts($id);

        if (!$contacts) {
            return back()->with('warning', 'Contatos não encontrados');
        }

        foreach ($contacts as $contact) {
            $phones = $this->phonesService->searchPhones($contact->contact_id);

            $addresses = $this->addressesService->searchAddresses($contact->contact_id);

            $contact->phones = $phones;
            $contact->addresses = $addresses;
        }

        return view('contacts', compact('contacts'));
    }

    public function store(ContactsRequest $request)
    {
        try {
            $contact = $this->contactsService->store($request);

            $phoneArray = [];
            foreach ($request->phones as $phone) {
                $newPhone = $this->phonesService->store($phone, $contact->contact_id);
                array_push($phoneArray, $newPhone);
            }

            $addressArray = [];
            foreach ($request->addresses as $address) {
                $newAddress = $this->addressesService->store($address, $contact->contact_id);
                array_push($addressArray, $newAddress);
            }

            $contact->phones = $phoneArray;
            $contact->addresses = $addressArray;
        } catch (Throwable $e) {
            return back()->with('error', $e);
        }


        return redirect()->route('contacts.index')->with('success', 'salvo com sucesso!');
    }

    public function update(ContactsRequest $request, $id)
    {
        try {
            $contact = $this->contactsService->update($request, $id);

            $phoneArray = [];
            $this->phonesService->deleteContactPhones($contact->contact_id);
            foreach ($request->phones as $phone) {
                $newPhone = $this->phonesService->store($phone, $contact->contact_id);
                array_push($phoneArray, $newPhone);
            }

            $addressArray = [];
            $this->addressesService->deleteContactAddresses($contact->contact_id);
            foreach ($request->addresses as $address) {
                $newAddress = $this->addressesService->store($address, $contact->contact_id);
                array_push($addressArray, $newAddress);
            }

            $contact->phones = $phoneArray;
            $contact->addresses = $addressArray;
        } catch (Throwable $e) {
            return back()->with('error', $e);
        }


        return redirect()->route('contacts.index')->with('success', 'salvo com sucesso!');
    }

    /**
     * Delete contact
     *
     * @param Request $request
     * @param $id
     * @return array
     */
    public function deleteContact($id)
    {
        $contact = $this->contactsService->find($id);

        if (!$contact) {
            return "Contato não encontrado";
        }

        $this->phonesService->deleteContactPhones($id);

        $this->addressesService->deleteContactAddresses($id);

        $this->contactsService->deleteContact($id);

        return redirect()->route('contacts.index')->with('success', 'deletado com sucesso!');
    }

    public function create()
    {
        return view('contact-form');
    }
}
