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
    public ?string $createdAt;
    public ?string $updatedAt;
    public string $name;
    public string $lastName;
    public string $phone;
    public string $street;
    public string $numberInStreet;
    public string $town;
    public ?string $password = null;
    public ?int $userType;

    public static function fromEntity(User $user) : self
    {
        return new self([
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'createdAt' => $user->getCreatedAt()->format(self::$formatTime),
            'updatedAt' => $user->getUpdatedAt()->format(self::$formatTime),
            'name' => $user->getPerson()->getName(),
            'lastName' => $user->getPerson()->getLastName(),
            'phone' => $user->getPerson()->getPhone()->getPhone(),
            'street' => $user->getPerson()->getAddress()->getStreet(),
            'numberInStreet' => $user->getPerson()->getAddress()->getNumber(),
            'town' => $user->getPerson()->getAddress()->getTown(),
            'userType' => $user->getRole()->getValue()
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
            'createdAt' => $request->has('createdAt')? $request->input('createdAt'): null,
            'updatedAt' => $request->has('updatedAt')? $request->input('updatedAt'): null,
            'name' => $request->input('name'),
            'lastName' => $request->input('lastName'),
            'phone' => $request->input('phone'),
            'street' => $request->input('street'),
            'numberInStreet' => $request->input('numberInStreet'),
            'town' =>  $request->input('town'),
            'password' => $request->has('password')? $request->input('password'): null
        ]);
    }

}