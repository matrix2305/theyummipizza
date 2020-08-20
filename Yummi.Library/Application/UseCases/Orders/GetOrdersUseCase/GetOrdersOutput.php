<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Orders\GetOrdersUseCase;


use Yummi\Application\UseCases\BaseDataTransferObject;
use Yummi\Domain\Entities\Order;
class GetOrdersOutput extends BaseDataTransferObject
{
    public ?string $id;
    public ?int $price;
    public int $phone;
    public string $email;
    public string $name;
    public string $lastName;
    public string $street;
    public string $numberOfStreet;
    public string $town;
    public ?string $createdAt;
    public ?string $updatedAt;
    public ?array $salads;
    public ?array $pizzas;
    public ?array $drinks;
    public ?array $sideDishes;
    public array $pizzaPriceId = [];

    public static function fromEntity(Order $order) : self
    {
        $order->setPrice();
        return new self([
            'id' => $order->getId(),
            'price' => $order->getPrice(),
            'phone' => $order->getPhone()->getPhone(),
            'email' => $order->getEmail()->getEmail(),
            'name' => $order->getName(),
            'lastName' => $order->getLastName(),
            'street' => $order->getAddress()->getStreet(),
            'numberOfStreet' => $order->getAddress()->getNumber(),
            'town' => $order->getAddress()->getTown(),
            'createdAt' => $order->getCreatedAt()->format(self::$formatTime),
            'updatedAt' => $order->getUpdatedAt()->format(self::$formatTime),
            'salads' => $order->getSalads()->toArray(),
            'pizzas' => $order->getPizzas()->toArray(),
            'drinks' => $order->getDrinks()->toArray(),
            'sideDishes' => $order->getSideDishes()->toArray()
        ]);
    }

    public static function fromCollection(array $orders) : array
    {
        $collection = [];
        if (!empty($orders)){
            foreach ($orders as $order){
                if ($order instanceof Order){
                    $collection[]=self::fromEntity($order);
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
            'price' => null,
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'lastName' => $request->input('lastName'),
            'street' => $request->input('street'),
            'numberOfStreet' => $request->input('numberOfStreet'),
            'town' => $request->input('town'),
            'createdAt' => null,
            'updatedAt' => $request->has('updatedAt')? $request->input('updatedAt'):null,
            'salads' => $request->has('salads')? $request->input('salads'):null,
            'pizzas' => $request->input('pizzas'),
            'sideDishes' => $request->input('sideDishes'),
            'drinks' => $request->has('drinks')? $request->input('drinks'):null,
            'pizzaPriceId' => $request->input('pizzaPriceId')
        ]);
    }
}