<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Salads\GetSaladsUseCase;


use Yummi\Application\UseCases\BaseDataTransferObject;
use Yummi\Domain\Entities\Salad;

class GetSaladsOutput extends BaseDataTransferObject
{
    public ?string $id;
    public string $name;
    public string $description;
    public string $imagePath;
    public ?string $createdAt;
    public ?string $updatedAt;

    public static function fromEntity(Salad $salad) : self
    {
        return new self([
            'id' => $salad->getId(),
            'name' => $salad->getName(),
            'description' => $salad->getDescription(),
            'imagePath' => $salad->getImagePath(),
            'createdAt' => $salad->getCreatedAt(),
            'updatedAt' => $salad->getUpdatedAt()
        ]);
    }

    public static function fromCollection(array $salads) : array
    {
        $collection = [];
        if (!empty($salads)){
            foreach ($salads as $salad){
                if ($salad instanceof Salad){
                    $collection[] = $salad;
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
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'imagePath' => $request->input('imagePath'),
            'createdAt' => $request->has('createdAt')? $request->input('createdAt'): null,
            'updatedAt' => $request->has('updatedAt')? $request->input('updatedAt'): null
        ]);
    }
}