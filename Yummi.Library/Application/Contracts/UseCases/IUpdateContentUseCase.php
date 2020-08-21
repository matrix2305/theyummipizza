<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\UseCases;


interface IUpdateContentUseCase
{
    public function Execute() : void;
}