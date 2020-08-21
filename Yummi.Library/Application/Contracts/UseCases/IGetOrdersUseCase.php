<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\UseCases;


interface IGetOrdersUseCase
{
    public function Execute() : void;
}