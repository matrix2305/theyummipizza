<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\UseCases;


interface IAddOrUpdateUserUseCase
{
    public function Execute() : void;
}