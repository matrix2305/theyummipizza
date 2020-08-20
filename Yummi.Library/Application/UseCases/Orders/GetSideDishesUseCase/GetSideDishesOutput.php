<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Orders\GetSideDishesUseCase;


use Yummi\Application\UseCases\BaseDataTransferObject;
use Yummi\Domain\Entities\SideDish;

class GetSideDishesOutput extends BaseDataTransferObject
{
    public ?string $id;
    public string $name;
    public ?string $updatedAt;

    public static function fromEntity(SideDish $sideDish) : self
    {
        return new self([
            'id' => $sideDish->getId(),
            'name' => $sideDish->getName(),
            'updatedAt' => $sideDish->getUpdatedAt()->format(self::$formatTime)
        ]);
    }

    public static function fromCollection(array $sideDishes) : array
    {
        $collection = [];
        if (!empty($sideDishes)){
            foreach ($sideDishes as $sideDish){
                if ($sideDish instanceof SideDish){
                    $collection[] = self::fromEntity($sideDish);
                }
            }
        }
        return $collection;
    }

    public static function fromRequest() : self
    {
        $request = request();
        return new self([
            'id' => $request->has('id')? $request->input('id'):null,
            'name' => $request->input('name'),
            'updatedAt' => $request->has('updatedAt')? $request->input('updatedAt'):null
        ]);
    }
}