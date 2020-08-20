<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Pizzas\GetPizzasUseCase;


use Yummi\Application\UseCases\BaseDataTransferObject;
use Yummi\Domain\Entities\Price;

class GetPricesOutput extends BaseDataTransferObject
{
    public string $id;
    public int $price;
    public string $size;

    public static function fromEntity(Price $price) : self
    {
        return new self([
            'id' => $price->getId(),
            'price' => $price->getPrice(),
            'size' => $price->getSize()->getDescription()
        ]);
    }

    public static function fromCollection(array $prices) : array
    {
        $collection = [];
        if (!empty($prices)){
            foreach ($prices as $price){
                if ($price instanceof Price){
                    $collection[] = self::fromEntity($price);
                }
            }
        }

        return $collection;
    }
}