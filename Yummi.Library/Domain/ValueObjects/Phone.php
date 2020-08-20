<?php
declare(strict_types=1);
namespace Yummi\Domain\ValueObjects;

use Doctrine\ORM\Mapping as ORM;
use RuntimeException;
/**
 * Class Phone
 * @package Yummi\Domain\ValueObjects
 * @ORM\Embeddable()
 */
class Phone
{
    /**
     * @var int|null
     * @ORM\Column (name="email", type="integer")
     */
    private ?int $phone;

    public function __construct(int $phone)
    {
        $this->phone = $phone;
        if (!$this->validate()) {
            throw new RuntimeException("Your phone number isn't valid, phone number must have minimum 8 numbers and maximum 14 numbers.");
        }
    }

    public function validate() : bool
    {
        return !(empty($this->phone) || strlen((string)$this->phone) > 14 || strlen((string)$this->phone) < 8);
    }

    public function getPhone() : ?int
    {
        return $this->phone;
    }
}