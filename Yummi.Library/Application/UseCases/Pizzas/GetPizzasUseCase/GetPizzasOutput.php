<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Pizzas\GetPizzasUseCase;


use Yummi\Application\UseCases\BaseDataTransferObject;
use Yummi\Domain\Entities\Pizza;

class GetPizzasOutput extends BaseDataTransferObject
{
    public ?string $id;
    public string $name;
    public string $description;
    public ?string $imagePath;
    public ?string $createdAt;
    public ?string $updatedAt;
    public $price;
    public ?int $rowVersion;

    public static function fromEntity(Pizza $pizza) : self
    {
        return new self([
            'id' => $pizza->getId(),
            'name' => $pizza->getName(),
            'description' => $pizza->getDescription(),
            'imagePath' => null,
            'createdAt' => $pizza->getCreatedAt()->format(self::$formatTime),
            'updatedAt' => $pizza->getUpdatedAt()->format(self::$formatTime),
            'price' => GetPricesOutput::fromCollection($pizza->getPrice()->toArray()),
            'rowVersion' => $pizza->getRowVersion()
        ]);
    }

    public static function fromCollection(array $pizzas) : array
    {
        $collection = [];
        if (!empty($pizzas)){
            foreach ($pizzas as $pizza){
                if ($pizza instanceof Pizza){
                    $collection[] = self::fromEntity($pizza);
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
            'imagePath' => null,
            'createdAt' => null,
            'updatedAt' => $request->has('updatedAt') ? $request->input('updatedAt') : null,
            'price' => $request->input('price'),
            'rowVersion' => $request->has('rowVersion')? (int)$request->input('rowVersion'): null
        ]);
    }
}