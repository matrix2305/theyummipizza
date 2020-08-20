<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases;


abstract class BaseDataTransferObject
{
    public static string $formatTime = 'd/m/Y  H:i:s';

    public function __construct(array $data)
    {
        foreach ($data as $property => $value){
            $this->{$property} = $value;
        }
    }
}