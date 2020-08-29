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
     * @var int $value
     * @ORM\Column (name="role", type="integer",length=2)
     */
    protected int $value;

    private const ADMINISTRATOR = 0;
    private const MODERATOR = 1;
    private const USER = 2;

    private const DESCRIPTION = [
        0 => 'Administrator',
        1 => 'Moderator',
        2 => 'User'
    ];
}