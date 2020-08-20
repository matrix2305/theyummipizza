<?php
declare(strict_types=1);
namespace Yummi\Infrastructure\DataAccess;

use Doctrine\ORM\EntityManagerInterface;
use Yummi\Application\Contracts\ILog;
use Yummi\Application\Contracts\Repositories\IPizzasRepository;
use Yummi\Domain\Entities\Pizza;
use Yummi\Domain\Entities\Price;
use Yummi\Domain\Entities\Size;

class PizzasRepository extends BaseRepository implements IPizzasRepository
{
    private string $pizza;
    private string $size;
    private string $price;


    public function __construct(EntityManagerInterface $em, ILog $log)
    {
        parent::__construct($em, $log);
        $this->pizza = Pizza::class;
    }

    public function getAllPizzas() : array
    {
        return $this->getAll($this->pizza);
    }

    public function getOnePizza(string $id) : Pizza
    {
        return $this->getOne($this->pizza, $id);
    }

    public function addOrUpdatePizza(Pizza $pizza, $version = null): void
    {
        $this->addOrUpdate($pizza, $version);
    }

    public function deletePizza(Pizza $pizza) : void
    {
        $this->remove($pizza);
    }

    public function getAllSizes() : array
    {
        return $this->getAll($this->size);
    }

    public function getOneSize(string $id) : Size
    {
        return $this->getOne($this->size, $id);
    }

    public function getOnePrice(string $id) : Price
    {
        return $this->getOne($this->price, $id);
    }
}