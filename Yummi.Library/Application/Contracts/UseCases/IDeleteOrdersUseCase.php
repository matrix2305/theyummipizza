<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\UseCases;


interface IDeleteOrdersUseCase
{
    public function Execute() : void;
}