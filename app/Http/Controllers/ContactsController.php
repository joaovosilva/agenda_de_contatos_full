<?php

namespace App\Http\Controllers;

use App\Events\NewContact;
use App\Http\Requests\ContactsRequest;
use App\Mail\NewContactMail;
use App\Services\AddressesService;
use App\Services\ContactsService;
use App\Services\EmailService;
use App\Services\Params\CreateAddressServiceParams;
use App\Services\Params\CreateContactServiceParams;
use App\Services\Params\CreatePhoneServiceParams;
use App\Services\Params\UpdateContactServiceParams;
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

    public function show($id)
    {
        $response = $this->contactsService->find($id);

        if (!$response->success) {
            return back()->with('warning', $response->message);
        }

        $contact = $response->data;
        $phonesResponse = $this->phonesService->searchPhones($contact->contact_id);
        $addressesResponse = $this->addressesService->searchAddresses($contact->contact_id);

        if (!$phonesResponse->success) {
            return back()->with('warning', $phonesResponse->message);
        }
        if (!$addressesResponse->success) {
            return back()->with('warning', $addressesResponse->message);
        }

        $contact->phones = $phonesResponse->data;
        $contact->addresses = $addressesResponse->data;

        return view('contact-modal', compact('contact'));
    }

    public function edit($id)
    {
        $response = $this->contactsService->find($id);

        if (!$response->success) {
            return back()->with('warning', $response->message);
        }

        $contact = $response->data;
        $phonesResponse = $this->phonesService->searchPhones($contact->contact_id);
        $addressesResponse = $this->addressesService->searchAddresses($contact->contact_id);

        if (!$phonesResponse->success) {
            return back()->with('warning', $phonesResponse->message);
        }
        if (!$addressesResponse->success) {
            return back()->with('warning', $addressesResponse->message);
        }

        $contact->phones = $phonesResponse->data;
        $contact->addresses = $addressesResponse->data;

        return view('contact-form', compact('contact'));
    }

    public function index()
    {

        $id = Auth::id();
        $response = $this->contactsService->searchContacts($id);

        if (!$response->success) {
            return back()->with('warning', $response->message);
        }

        $contacts = $response->data;

        foreach ($contacts as $contact) {
            $phonesResponse = $this->phonesService->searchPhones($contact->contact_id);
            $addressesResponse = $this->addressesService->searchAddresses($contact->contact_id);

            if (!$phonesResponse->success) {
                return back()->with('warning', $phonesResponse->message);
            }
            if (!$addressesResponse->success) {
                return back()->with('warning', $addressesResponse->message);
            }

            $contact->phones = $phonesResponse->data;
            $contact->addresses = $addressesResponse->data;
        }

        return view('contacts', compact('contacts'));
    }

    public function store(ContactsRequest $request)
    {
        try {
            $id = Auth::id();
            $contactParams = new CreateContactServiceParams(
                $request->name,
                $id,
                $request->company,
                $request->role,
            );

            $response = $this->contactsService->createContact($contactParams);

            if (!$response->success) {
                return back()->with('warning', $response->message);
            }

            $contact = $response->data;

            $phoneArray = [];
            foreach ($request->phones as $phone) {
                $phoneParams = new CreatePhoneServiceParams(
                    $phone['type'],
                    $phone['phone'],
                    $contact->contact_id,
                );
                $response = $this->phonesService->createPhone($phoneParams);

                if (!$response->success) {
                    return back()->with('warning', $response->message);
                }

                array_push($phoneArray, $response->data);
            }

            $addressArray = [];
            foreach ($request->addresses as $address) {
                $addressParams = new CreateAddressServiceParams(
                    $address['zip_code'],
                    $address['street'],
                    $address['number'],
                    $address['neighborhood'],
                    $address['complement'],
                    $address['city'],
                    $address['state'],
                    $contact->contact_id,
                );
                $response = $this->addressesService->createAddress($addressParams);

                if (!$response->success) {
                    return back()->with('warning', $response->message);
                }
                array_push($addressArray, $response->data);
            }

            $contact->phones = $phoneArray;
            $contact->addresses = $addressArray;

            $user = Auth::user();
            event(new NewContact($contact, $user->email));
        } catch (Throwable $e) {
            return back()->with('error', $e);
        }

        return redirect()->route('contacts.index')->with('success', 'salvo com sucesso!');
    }

    public function update(ContactsRequest $request, $id)
    {
        try {
            $contactParams = new UpdateContactServiceParams(
                $request->name,
                $request->company,
                $request->role
            );
            $response = $this->contactsService->updateContact($contactParams, $id);

            if (!$response->success) {
                return back()->with('warning', $response->message);
            }

            $contact = $response->data;

            $phoneArray = [];
            $this->phonesService->deleteContactPhones($contact->contact_id);
            foreach ($request->phones as $phone) {
                $phoneParams = new CreatePhoneServiceParams(
                    $phone['type'],
                    $phone['phone'],
                    $contact->contact_id,
                );
                $response = $this->phonesService->createPhone($phoneParams);
                if (!$response->success) {
                    return back()->with('warning', $response->message);
                }

                array_push($phoneArray, $response->data);
            }

            $addressArray = [];
            $this->addressesService->deleteContactAddresses($contact->contact_id);
            foreach ($request->addresses as $address) {
                $addressParams = new CreateAddressServiceParams(
                    $address['zip_code'],
                    $address['street'],
                    $address['number'],
                    $address['neighborhood'],
                    $address['complement'],
                    $address['city'],
                    $address['state'],
                    $contact->contact_id,
                );

                $response = $this->addressesService->createAddress($addressParams);

                if (!$response->success) {
                    return back()->with('warning', $response->message);
                }

                array_push($addressArray, $response->data);
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
    public function destroy($id)
    {
        $response = $this->contactsService->find($id);

        if (!$response->success) {
            return back()->with('warning', $response->message);
        }

        $phonesResponse = $this->phonesService->deleteContactPhones($id);

        $addressesResponse = $this->addressesService->deleteContactAddresses($id);

        $response = $this->contactsService->deleteContact($id);

        if (!$response->success || !$phonesResponse->success || !$addressesResponse->success) {
            return back()->with('warning', 'Erro ao deletar contato, tente novamente');
        }

        return redirect()->route('contacts.index')->with('success', 'deletado com sucesso!');
    }

    public function create()
    {
        return view('contact-form');
    }

    // public function testMail()
    // {
    //     $response = $this->contactsService->find(48);

    //     if (!$response->success) {
    //         return back()->with('warning', $response->message);
    //     }

    //     $contact = $response->data;
    //     $phonesResponse = $this->phonesService->searchPhones($contact->contact_id);
    //     $addressesResponse = $this->addressesService->searchAddresses($contact->contact_id);

    //     if (!$phonesResponse->success) {
    //         return back()->with('warning', $phonesResponse->message);
    //     }
    //     if (!$addressesResponse->success) {
    //         return back()->with('warning', $addressesResponse->message);
    //     }

    //     $contact->phones = $phonesResponse->data;
    //     $contact->addresses = $addressesResponse->data;

    //     return new NewContactMail($contact);
    // }
}
