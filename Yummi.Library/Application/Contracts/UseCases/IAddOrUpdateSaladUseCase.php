<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\UseCases;


interface IAddOrUpdateSaladUseCase
{
    public function Execute() : void;
}