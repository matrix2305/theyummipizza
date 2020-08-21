<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\UseCases;


interface IDeleteSideDishesUseCase
{
    public function Execute() : void;
}