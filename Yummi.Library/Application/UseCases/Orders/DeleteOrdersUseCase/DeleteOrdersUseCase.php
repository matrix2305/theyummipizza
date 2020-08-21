<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Orders\DeleteOrdersUseCase;


use RuntimeException;
use Yummi\Application\Contracts\Repositories\IOrderRepository;
use Yummi\Application\Contracts\UseCases\IDeleteOrdersUseCase;

class DeleteOrdersUseCase implements IDeleteOrdersUseCase
{
    private IOrderRepository $orderRepository;

    public function __construct(IOrderRepository $orderRepository){
        $this->orderRepository = $orderRepository;
    }

    public function Execute() : void
    {
        if ($id = request()->input('id')){
           $order = $this->orderRepository->getOneOrder($id);
           $this->orderRepository->deleteOrder($order);
        }else{
            throw new RuntimeException("Request don't have id.");
        }
    }
}