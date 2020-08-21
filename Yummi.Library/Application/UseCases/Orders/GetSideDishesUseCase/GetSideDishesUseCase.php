<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Orders\GetSideDishesUseCase;


use Yummi\Application\Contracts\Repositories\IOrderRepository;
use Yummi\Application\Contracts\UseCases\IGetSideDishesUseCase;
use Yummi\Domain\Entities\SideDish;

class GetSideDishesUseCase implements IGetSideDishesUseCase
{
    private IOrderRepository $orderRepository;

    public function __construct(IOrderRepository $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    public function Execute()
    {
        if ($id = request()->input('id')){
            $sideDish = $this->orderRepository->getOneSideDish($id);
            return GetSideDishesOutput::fromEntity($sideDish);
        }

        $sideDishes = $this->orderRepository->getAllSideDishes();
        return GetSideDishesOutput::fromCollection($sideDishes);
    }
}