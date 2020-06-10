<?php

namespace App\Services;

use App\Repositories\UsersRepository;
use App\Services\Contracts\UsersInterface;
use App\Users;

class UsersService implements UsersInterface
{
    public $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * Traz um usuario pelo id
     *
     * @param  int|string $id
     *
     * @return user
     */
    public function find($id)
    {
        try {
            $user = $this->usersRepository->find($id);
        } catch (ModelNotFoundException $e) {
            return 'Usuário não encontrado';
        } catch (Throwable $e) {
            return $e;
        }

        return $user;
    }
    /**
     * Traz todos usuarios
     *
     * @return users
     */
    public function getAll()
    {
        try {
            $users = $this->usersRepository->getAll();
        } catch (ModelNotFoundException $e) {
            return 'Usuários não encontrado';
        } catch (Throwable $e) {
            return $e;
        }

        return $users;
    }

    public function storeOrUpdate($request)
    {
        try {
            $request->password = bcrypt($request->password);

            $user = $this->usersRepository->save($request);
        } catch (Throwable $e) {
            return $e;
        }

        return $user;
    }

    public function searchByEmail($email)
    {
        try {
            $user = $this->usersRepository->getByEmail($email);
        } catch (ModelNotFoundException $e) {
            return false;
        } catch (Throwable $e) {
            return $e;
        }

        return $user;
    }
}
