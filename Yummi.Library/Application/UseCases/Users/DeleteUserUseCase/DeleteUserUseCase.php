<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Users\DeleteUserUseCase;


use RuntimeException;
use Yummi\Application\Contracts\Repositories\IUsersRepository;

class DeleteUserUseCase
{
    private IUsersRepository $usersRepository;

    public function __construct(IUsersRepository $usersRepository) {
        $this->usersRepository = $usersRepository;
    }

    public function Execute(): void
    {
        if ($id = request()->input('id')){
            $user = $this->usersRepository->getOneUser($id);
            $this->usersRepository->deleteUser($user);
        }else{
            throw new RuntimeException("Request don't have id.");
        }
    }
}