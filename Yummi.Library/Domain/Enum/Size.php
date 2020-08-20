<?php
declare(strict_types=1);
namespace Yummi\Domain\Enum;

use Doctrine\ORM\Mapping as ORM;
use Yummi\Domain\AEnum;

/**
 * Class Size
 * @package Yummi\Domain\Enum
 * @ORM\Embeddable
 */
class Size extends AEnum
{
    /**
     * @var int
     * @ORM\Column (name="size", type="integer", length=2)
     */
    protected int $value;

    private const SIZE_1 = 1;
    private const SIZE_2 = 2;
    private const SIZE_3 = 3;

    private const DESCRIPTION = [
        0 => null,
        1 => '24cm',
        2 => '32cm',
        3 => '50cm'
    ];
}