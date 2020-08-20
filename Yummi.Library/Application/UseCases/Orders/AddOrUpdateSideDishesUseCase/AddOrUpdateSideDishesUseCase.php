<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Orders\AddOrUpdateSideDishesUseCase;


use Yummi\Application\Contracts\Repositories\IOrderRepository;
use Yummi\Application\UseCases\Orders\GetSideDishesUseCase\GetSideDishesOutput;
use Yummi\Domain\Entities\SideDish;

class AddOrUpdateSideDishesUseCase
{
    private IOrderRepository $orderRepository;

    public function __construct(IOrderRepository $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    public function Execute() : void
    {
        $data = GetSideDishesOutput::fromRequest();
        if (!empty($data->id)){
            $sideDish = $this->orderRepository->getOneSideDish($data->id);
            $version = $data->updatedAt;
        }else{
            $sideDish = new SideDish();
            $version = null;
        }
        $sideDish->setName($data->name);
        $this->orderRepository->addOrUpdateSideDish($sideDish, $version);
    }
}