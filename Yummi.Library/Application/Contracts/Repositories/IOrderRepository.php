<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\Repositories;


use Yummi\Domain\Entities\Order;
use Yummi\Domain\Entities\SideDish;

interface IOrderRepository
{
    public function getAllOrders() : array;

    public function getOneOrder(string $id) : Order;

    public function addOrUpdateOrder(Order $order, $version = null) : void;

    public function deleteOrder(Order $order) : void;

    public function getAllSideDishes() : array;

    public function getOneSideDish(string $id) : SideDish;

    public function addOrUpdateSideDish(SideDish $sideDish, $version = null): void;

    public function deleteSideDish(SideDish $sideDish) : void;
}