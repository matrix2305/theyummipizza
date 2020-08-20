<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Orders\AddOrUpdateOrdersUseCase;


use RuntimeException;
use Yummi\Application\Contracts\Repositories\IDrinksRepository;
use Yummi\Application\Contracts\Repositories\IOrderRepository;
use Yummi\Application\Contracts\Repositories\IPizzasRepository;
use Yummi\Application\Contracts\Repositories\ISaladsRepository;
use Yummi\Application\UseCases\Orders\GetOrdersUseCase\GetOrdersOutput;
use Yummi\Domain\Entities\Order;
use Yummi\Domain\ValueObjects\Address;
use Yummi\Domain\ValueObjects\Email;
use Yummi\Domain\ValueObjects\Phone;

class AddOrUpdateOrdersUseCase
{
    private IOrderRepository $orderRepository;
    private IPizzasRepository $pizzaRepository;
    private ISaladsRepository $saladsRepository;
    private IDrinksRepository $drinksRepository;

    public function __construct(IOrderRepository $orderRepository, IPizzasRepository $pizzaRepository, ISaladsRepository $saladsRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->pizzaRepository = $pizzaRepository;
        $this->saladsRepository = $saladsRepository;
    }

    public function Execute() : void
    {
        $data = GetOrdersOutput::fromRequest();
        if (!empty($data->id)){
            $order = $this->orderRepository->getOneOrder($data->id);
            $version = $data->updatedAt;
        }else{
            $order = new Order();
            $version = null;
        }
        if (!empty($data->pizzaPriceId)){
            foreach ($data->pizzaPriceId as $id){
                $price = $this->pizzaRepository->getOnePrice($id)->getPrice();
                $order->setPricePizza($price);
            }
        }else{
            throw new RuntimeException("You aren't selected no one product, please select product.");
        }
        foreach ($data->pizzas as $id){
            $pizza = $this->pizzaRepository->getOnePizza($id);
            $order->setPizzas($pizza);
        }
        if (!empty($data->salads)){
            foreach ($data->salads as $id){
                $salad = $this->saladsRepository->getOneSalad($id);
                $order->setSalads($salad);
            }
        }
        if (!empty($data->drinks)){
            foreach ($data->drinks as $id){
                $drink = $this->drinksRepository->getOneDrink($id);
                $order->setDrinks($drink);
            }
        }
        $order->setName($data->name);
        $order->setLastName($data->lastName);
        $email = new Email($data->email);
        $order->setEmail($email);
        $address = new Address($data->street, $data->numberOfStreet, $data->town);
        $order->setAddress($address);
        $phone = new Phone($data->phone);
        $order->setPhone($phone);
        $order->setPrice();
        $this->orderRepository->addOrUpdateOrder($order, $version);

    }

}