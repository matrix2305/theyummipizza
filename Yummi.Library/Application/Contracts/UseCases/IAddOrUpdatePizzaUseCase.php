<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\UseCases;


interface IAddOrUpdatePizzaUseCase
{
    public function Execute() : void;
}