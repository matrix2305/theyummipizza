<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\UseCases;


interface IAddOrUpdateOrdersUseCase
{
    public function Execute() : void;
}