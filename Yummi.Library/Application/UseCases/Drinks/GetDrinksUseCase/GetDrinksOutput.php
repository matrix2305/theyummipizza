<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Drinks\GetDrinksUseCase;


use Yummi\Application\UseCases\BaseDataTransferObject;
use Yummi\Domain\Entities\Drink;

class GetDrinksOutput extends BaseDataTransferObject
{
    public ?string $id;
    public string $name;
    public int $price;
    public string $imagePath;
    public ?string $updatedAt;

    public static function fromEntity(Drink $drink) : self
    {
        return new self(
            [
                'id' => $drink->getId(),
                'name' => $drink->getName(),
                'price' => $drink->getPrice(),
                'imagePath' => $drink->getImagePath(),
                'updatedAt' => $drink->getUpdatedAt()
            ]
        );
    }

    public static function fromCollection(array $drinks) : array
    {
        $collection = [];
        if (!empty($drinks)){
            foreach ($drinks as $drink){
                if ($drink instanceof Drink){
                    $collection[] = self::fromEntity($drink);
                }
            }
        }

        return $collection;
    }

    public static function fromRequest() : self
    {
        $request = request();
        return new self([
            'id' => $request->has('id')? $request->input('id') : null,
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'imagePath' => $request->input('imagePath'),
            'updatedAt' => $request->has('updatedAt')? $request->input('updatedAt') : null

        ]);
    }
}