<?php
declare(strict_types=1);
namespace Yummi\Infrastructure\DataAccess;


use Doctrine\ORM\EntityManagerInterface;
use Yummi\Application\Contracts\ILog;
use Yummi\Application\Contracts\Repositories\IDrinksRepository;
use Yummi\Domain\Entities\Drink;

class DrinksRepository extends BaseRepository implements IDrinksRepository
{
    public string $drink;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);
        $this->drink = Drink::class;
    }

    public function getAllDrinks(): array
    {
        return $this->getAll($this->drink);
    }

    public function getOneDrink(string $id): Drink
    {
        return $this->getOne($this->drink, $id);
    }

    public function addOrUpdateDrink(Drink $drink, $version) : void
    {
        $this->addOrUpdate($drink, $version);
    }

    public function deleteDrink(Drink $drink): void
    {
        $this->remove($drink);
    }
}