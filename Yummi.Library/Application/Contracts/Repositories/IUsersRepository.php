<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\Repositories;


use Yummi\Domain\Entities\User;

interface IUsersRepository
{
    public function getAllUsers() : array;

    public function getOneUser(string $id) : User;

    public function addOrUpdateUser(User $user, $version = null): void;

    public function deleteUser(User $user) : void;

    public function getUserByEmailOrUserName(string $input) : User;
}