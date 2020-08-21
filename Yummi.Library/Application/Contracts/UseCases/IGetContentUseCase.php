<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\UseCases;


use Yummi\Application\UseCases\Content\GetContentUseCase\GetContentOutput;

interface IGetContentUseCase
{
    public function Execute() : GetContentOutput;
}