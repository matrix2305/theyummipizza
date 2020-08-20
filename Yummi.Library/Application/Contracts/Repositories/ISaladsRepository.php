<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\Repositories;


use Yummi\Domain\Entities\Salad;

interface ISaladsRepository
{
    public function getAllSalads() : array;

    public function getOneSalad(string $id) : Salad;

    public function addOrUpdateSalad(Salad $salad, $version = null) : void;

    public function deleteSalad(Salad $salad) : void;
}