<?php
declare(strict_types=1);
namespace Yummi\Infrastructure\DataAccess;


use Doctrine\ORM\EntityManagerInterface;
use Yummi\Application\Contracts\ILog;
use Yummi\Application\Contracts\Repositories\IOrderRepository;
use Yummi\Domain\Entities\Order;
use Yummi\Domain\Entities\SideDish;

class OrderRepository extends BaseRepository implements IOrderRepository
{
    private string $order;
    private string $sideDish;

    public function __construct(EntityManagerInterface $em, ILog $log)
    {
        parent::__construct($em, $log);
        $this->order = Order::class;
        $this->sideDish = SideDish::class;
    }

    public function getAllOrders() : array
    {
        return $this->getAll($this->order);
    }

    public function getOneOrder(string $id) : Order
    {
        return $this->getOne($this->order, $id);
    }

    public function addOrUpdateOrder(Order $order, $version = null) : void
    {
        $this->addOrUpdate($order, $version);
    }

    public function deleteOrder(Order $order) : void
    {
        $this->remove($order);
    }

    public function getAllSideDishes() : array
    {
        return $this->getAll($this->sideDish);
    }

    public function getOneSideDish(string $id) : SideDish
    {
        return $this->getOne($this->sideDish, $id);
    }

    public function addOrUpdateSideDish(SideDish $sideDish, $version = null): void
    {
        $this->addOrUpdate($sideDish, $version);
    }

    public function deleteSideDish(SideDish $sideDish) : void
    {
        $this->remove($sideDish);
    }
}