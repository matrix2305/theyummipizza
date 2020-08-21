<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Orders\GetOrdersUseCase;

use RuntimeException;
use Yummi\Application\Contracts\Repositories\IOrderRepository;
use Yummi\Application\Contracts\UseCases\IGetOrdersUseCase;

class GetOrdersUseCase implements IGetOrdersUseCase
{
    private IOrderRepository $ordersRepository;

    public function __construct(IOrderRepository $orderRepository){
        $this->ordersRepository = $orderRepository;
    }

    public function Execute() : void
    {
        if ($id = request()->input('id')){
            $order = $this->ordersRepository->getOneOrder($id);
            $this->ordersRepository->deleteOrder($order);
        }else{
            throw new RuntimeException("Request don't have id.");
        }
    }
}