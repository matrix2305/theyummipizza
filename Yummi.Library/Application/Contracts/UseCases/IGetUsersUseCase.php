<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\UseCases;


interface IGetUsersUseCase
{
    public function Execute(?string $email = null);
}