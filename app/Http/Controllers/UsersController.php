<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Users;
use App\Services\UsersService;

class UsersController extends Controller
{
    protected $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function getUserById($id)
    {
        $user = $this->usersService->find($id);

        if (!$user) {
            return ResponseService::returnApi(false, null, "Usuário não encontrado");
        }

        return ResponseService::returnApi(true, $user, null);
    }

    // retrieve all users
    public function getAllUsers()
    {
        if (!ResponseService::validationUser()) {
            return ResponseService::returnApi(false, null, "Autenticação Invállida");
        }

        $users = $this->usersService->getAll();

        return ResponseService::returnApi(true, $users);
    }

    // register an user
    public function registerUser(UsersRequest $request)
    {
        $emailExists = $this->usersService->searchByEmail($request->email);

        if ($emailExists) {
            return ResponseService::returnApi(false, null, "E-mail já cadastrado");
        }

        $user = $this->usersService->storeOrUpdate($request);

        return ResponseService::returnApi(true, $user);
    }

    // public function index(Request $request) {
    //     if ($request) {
    //         $search = trim($request->get('contactSearch'));
    //         $contacts = DB::table('tb_contacts')->
    //             where('name', 'like', '%'.$search.'%');
    //     }
    // }
}
