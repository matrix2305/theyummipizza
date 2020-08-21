<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\UseCases;


interface IDeleteUserUseCase
{
    public function Execute(): void;
}