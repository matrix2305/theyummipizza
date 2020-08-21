<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\UseCases;


interface IAddOrUpdateSideDishesUseCase
{
    public function Execute() : void;
}