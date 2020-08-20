<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\Repositories;


use Yummi\Domain\Entities\Pizza;
use Yummi\Domain\Entities\Price;
use Yummi\Domain\Entities\Size;

interface IPizzasRepository
{
    public function getAllPizzas() : array;

    public function getOnePizza(string $id) : Pizza;

    public function addOrUpdatePizza(Pizza $pizza, $version = null): void;

    public function deletePizza(Pizza $pizza) : void;

    public function getAllSizes() : array;

    public function getOneSize(string $id) : Size;

    public function getOnePrice(string $id) : Price;
}