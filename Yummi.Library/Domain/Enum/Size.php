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

    private const SIZE_1 = 0;
    private const SIZE_2 = 1;
    private const SIZE_3 = 2;

    private const DESCRIPTION = [
        0 => '24cm',
        1 => '32cm',
        2 => '50cm'
    ];
}