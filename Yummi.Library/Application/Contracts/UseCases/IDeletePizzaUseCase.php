<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\UseCases;


interface IDeletePizzaUseCase
{
    public function Execute() : void;
}