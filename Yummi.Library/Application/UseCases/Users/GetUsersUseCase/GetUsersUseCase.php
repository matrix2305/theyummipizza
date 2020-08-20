<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Users\GetUsersUseCase;


use Yummi\Application\Contracts\Repositories\IUsersRepository;
use Yummi\Application\Contracts\UseCases\IGetUsersUseCase;

class GetUsersUseCase implements IGetUsersUseCase
{
    private IUsersRepository $usersRepository;

    public function __construct(IUsersRepository $usersRepository){
        $this->usersRepository = $usersRepository;
    }

    public function Execute(?string $email = null)
    {
        if ($email !== null){
            $user = $this->usersRepository->getUserByEmailOrUserName($email);
            return GetUsersOutput::fromEntity($user);
        }

        if ($id = request()->input('id')){
            $user = $this->usersRepository->getOneUser($id);
            return GetUsersOutput::fromEntity($user);
        }

        $users = $this->usersRepository->getAllUsers();
        return GetUsersOutput::fromCollection($users);
    }
}