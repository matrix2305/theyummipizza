<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Users\GetUsersUseCase;


use Yummi\Application\UseCases\BaseDataTransferObject;
use Yummi\Domain\Entities\User;

class GetUsersOutput extends BaseDataTransferObject
{
    public ?string $id;
    public string $username;
    public string $email;
    public ?string $avatarPath;
    public ?string $createdAt;
    public ?string $updatedAt;
    public string $name;
    public string $lastName;
    public string $phone;
    public string $street;
    public string $numberOfStreet;
    public string $town;
    public ?string $password = null;

    public static function fromEntity(User $user) : self
    {
        return new self([
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'avatarPath' => $user->getAvatarPath(),
            'createdAt' => $user->getCreatedAt(),
            'updatedAt' => $user->getUpdatedAt(),
            'name' => $user->getPerson()->getName(),
            'lastName' => $user->getPerson()->getLastName(),
            'phone' => $user->getPerson()->getPhone()->getPhone(),
            'street' => $user->getPerson()->getAddress()->getStreet(),
            'numberOfStreet' => $user->getPerson()->getAddress()->getNumber(),
            'town' => $user->getPerson()->getAddress()->getTown()
        ]);
    }

    public static function fromCollection(array $users) : array
    {
        $collection = [];
        if (!empty($users)){
            foreach ($users as $user){
                if ($user instanceof User){
                    $collection[] = self::fromEntity($user);
                }
            }
        }

        return $collection;
    }

    public static function fromRequest() : self
    {
        $request = request();
        return new self([
            'id' => $request->has('id')? $request->input('id'): null,
            'username' =>  $request->input('username'),
            'email' =>  $request->input('email'),
            'avatarPath' => null,
            'createdAt' => $request->has('createdAt')? $request->input('createdAt'): null,
            'updatedAt' => $request->has('updatedAt')? $request->input('updatedAt'): null,
            'name' => $request->input('name'),
            'lastName' => $request->input('lastName'),
            'phone' => $request->input('phone'),
            'street' => $request->input('street'),
            'numberOfStreet' => $request->input('numberOfStreet'),
            'town' =>  $request->input('town'),
            'password' => $request->has('password')? $request->input('password'): null
        ]);
    }

}