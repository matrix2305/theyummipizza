<?php
declare(strict_types=1);
namespace Yummi\Domain\Enum;

use Doctrine\ORM\Mapping as ORM;
use Yummi\Domain\AEnum;

/**
 * Class Role
 * @package Yummi\Domain\ValueObjects
 * @ORM\Embeddable
 */
class Role extends AEnum
{
    /**
     * @var $value
     * @ORM\Column (name="role", type="integer",length=2)
     */
    protected int $value;

    private const ADMINISTRATOR = 1;
    private const MODERATOR = 2;
    private const USER = 3;

    private const DESCRIPTION = [
        0 => null,
        1 => 'Administrator',
        2 => 'Moderator',
        3 => 'User'
    ];
}