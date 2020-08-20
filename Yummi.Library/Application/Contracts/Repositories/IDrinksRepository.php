<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\Repositories;


use Yummi\Domain\Entities\Drink;

interface IDrinksRepository
{
    public function getAllDrinks() : array;

    public function getOneDrink(string $id): Drink;

    public function addOrUpdateDrink(Drink $drink, $version = null) : void;

    public function deleteDrink(Drink $drink): void;
}