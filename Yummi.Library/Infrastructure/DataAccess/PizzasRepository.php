<?php
declare(strict_types=1);
namespace Yummi\Infrastructure\DataAccess;

use Doctrine\ORM\EntityManagerInterface;
use Yummi\Application\Contracts\Repositories\IPizzasRepository;
use Yummi\Domain\Entities\Pizza;
use Yummi\Domain\Entities\Price;

class PizzasRepository extends BaseRepository implements IPizzasRepository
{
    private string $pizza;
    private string $price;


    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);
        $this->pizza = Pizza::class;
        $this->price = Price::class;
    }

    public function getAllPizzas() : array
    {
        return $this->getAll($this->pizza);
    }

    public function getOnePizza(string $id) : Pizza
    {
        return $this->getOne($this->pizza, $id);
    }

    public function addOrUpdatePizza(Pizza $pizza, int $version): void
    {
        $this->addOrUpdate($pizza, $version);
    }

    public function deletePizza(Pizza $pizza) : void
    {
        $this->remove($pizza);
    }


    public function getOnePrice(string $id) : Price
    {
        return $this->getOne($this->price, $id);
    }
}