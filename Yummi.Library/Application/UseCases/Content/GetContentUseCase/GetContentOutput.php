<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Content\GetContentUseCase;


use Yummi\Application\UseCases\BaseDataTransferObject;
use Yummi\Domain\Entities\Content;

class GetContentOutput extends BaseDataTransferObject
{
    public ?string $id;
    public string $description;
    public string $email;
    public string $phone;
    public string $street;
    public string $numberOfStreet;
    public string $town;
    public string $updateAt;

    public static function fromEntity(Content $content) : self
    {
        return new self(
            [
                'id' => $content->getId(),
                'description' => $content->getDescription(),
                'email' => $content->getEmail()->getEmail(),
                'phone' => $content->getPhone()->getPhone(),
                'street' => $content->getAddress()->getStreet(),
                'numberOfStreet' => $content->getAddress()->getNumber(),
                'town' => $content->getAddress()->getTown(),
                'updatedAt' => $content->getUpdatedAt()->format(self::$formatTime)
            ]
        );
    }

    public static function fromRequest() : self
    {
        $request = request();
        return new self(
            [
                'id' => null,
                'description' => $request->input('description'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'street' => $request->input('street'),
                'numberOfStreet' => $request->input('numberOfStreet'),
                'town' => $request->input('town'),
                'updatedAt' => $request->input('updatedAt')
            ]
        );
    }

}