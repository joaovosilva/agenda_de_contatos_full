<?php

namespace App\Repositories;

use App\Models\Users;

/**
 * Interface UsersRepository.
 *
 * @package namespace App\Repositories;
 */
class UsersRepository
{
    protected $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function find($id)
    {
        return $this->users->find($id);
    }

    public function getAll()
    {
        return $this->users->all();
    }

    // create or update an user
    public function save($request)
    {
        $user = null;
        $user = new Users();

        if ($request->id != null && $request->id != "") {
            $user = $this->users->find($request->id);
        }

        if (!$user) {
            return false;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return $user;
    }

    public function getByEmail($email)
    {
        $user = $this->users->where([
            ["email", "=", $email]
        ])->get();

        return $user;
    }
}
