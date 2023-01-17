<?php

namespace App\Repositories;

interface UserRepositoryInterface {
    public function store($user);
    public function show($data);
    public function update($data, $id);
}
