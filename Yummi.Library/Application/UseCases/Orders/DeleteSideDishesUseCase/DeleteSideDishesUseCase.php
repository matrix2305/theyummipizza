<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Orders\DeleteSideDishesUseCase;


use Yummi\Application\Contracts\Repositories\IOrderRepository;
use RuntimeException;
use Exception;

class DeleteSideDishesUseCase
{
    private IOrderRepository $orderRepository;

    public function __construct(IOrderRepository $orderRepository){
        $this->orderRepository = $orderRepository;
    }

    public function Execute() : void
    {
        if ($id = request()->input('id')){
            try {
                $sideDish = $this->orderRepository->getOneSideDish($id);
                $this->orderRepository->deleteSideDish($sideDish);
            }catch (Exception $exception){
                throw new RuntimeException("Side dish is tied for orders, you can't delete side dish.");
            }
        }else{
            throw new RuntimeException("Request don't have id.");
        }
    }
}