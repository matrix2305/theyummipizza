<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Users\AddOrUpdateUserUseCase;


use Illuminate\Support\Facades\Hash;
use Yummi\Application\Contracts\Repositories\IUsersRepository;
use Yummi\Application\UseCases\Users\GetUsersUseCase\GetUsersOutput;
use Yummi\Domain\Entities\Person;
use Yummi\Domain\Entities\User;
use Yummi\Domain\ValueObjects\Address;
use Yummi\Domain\ValueObjects\Phone;
use Yummi\Infrastructure\Services\ImageUploader\ImageUpload;

class AddOrUpdateUserUseCase
{
    private IUsersRepository $usersRepository;

    public function __construct(IUsersRepository $usersRepository){
        $this->usersRepository = $usersRepository;
    }

    public function Execute() : void
    {
        $data = GetUsersOutput::fromRequest();
        if (!empty($data->id)){
            $user = $this->usersRepository->getOneUser($data->id);
            $version = $data->updatedAt;
        }else{
            $user = new User();
            $version = null;
        }
        if (!empty($data->password)){
            $user->setPassword(Hash::make($data->password));
        }
        $user->setUsername($data->username);
        if (request()->hasFile('avatar')){
            $image = ImageUpload::Upload("storage/users/avatars/", "avatar");
            $user->setAvatarPath($image);
        }else{
            $user->setAvatarPath("storage/users/avatars/noavatar.png");
        }
        $user->setEmail($data->email);
        $address = new Address($data->street, $data->numberOfStreet, $data->town);
        $person = new Person();
        $person->setAddress($address);
        $person->setName($data->name);
        $person->setLastName($data->lastName);
        $phone = new Phone((int)$data->phone);
        $person->setPhone($phone);
        $user->setPerson($person);
        $this->usersRepository->addOrUpdateUser($user, $version);
    }
}