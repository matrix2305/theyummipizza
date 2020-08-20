<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts;


interface ILog
{
    public function AddLog(string $log): void;
}