<?php

namespace App\Repositories;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $userModel;
    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }
    public function store($user) {
        return $this->userModel->create($user);
    }
    public function show($data) {
        return $this->userModel->find($data);
    }
    public function update($data, $id) {
        $user =  $this->userModel->find($id);
        if($user)
            return $this->userModel->update($data);
        else
            return $user;
    }
}
