<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\UseCases;


interface IAddOrUpdateDrinkUseCase
{
    public function Execute() : void;
}