<?php
declare(strict_types=1);
namespace Yummi\Infrastructure\DataAccess;


use Doctrine\ORM\EntityManagerInterface;
use Exception;
use RuntimeException;
use Yummi\Application\Contracts\Repositories\IUsersRepository;
use Yummi\Domain\Entities\User;

class UsersRepository extends BaseRepository implements IUsersRepository
{
    private string $user;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);
        $this->user = User::class;
    }

    public function getAllUsers() : array
    {
        return $this->getAll($this->user);
    }

    public function getOneUser(string $id) : User
    {
        return $this->getOne($this->user, $id);
    }

    public function addOrUpdateUser(User $user, $version = null): void
    {
        $this->addOrUpdate($user, $version);
    }

    public function deleteUser(User $user) : void
    {
        $this->remove($user);
    }

    public function getUserByEmailOrUserName(string $input) : User
    {
        filter_var($input, FILTER_VALIDATE_EMAIL)? $field = 'email' : $field = 'username';
        $user = $this->em->getRepository($this->user)->findOneBy([$field => $input]);
        if (!$user){
            throw new RuntimeException('User not found!');
        }

        return $user;
    }
}