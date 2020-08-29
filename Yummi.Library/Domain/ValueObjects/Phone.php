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
     * @var string|null
     * @ORM\Column (name="phone", type="string", length=14)
     */
    private ?string $phone;

    public function __construct(string $phone)
    {
        $this->phone = $phone;
        if (!$this->validate()) {
            throw new RuntimeException("Your phone number isn't valid, phone number must have minimum 8 numbers and maximum 14 numbers.");
        }
    }

    public function validate() : bool
    {
        return !(empty($this->phone) || strlen($this->phone) > 14 || strlen($this->phone) < 8);
    }

    public function getPhone() : ?string
    {
        return $this->phone;
    }
}