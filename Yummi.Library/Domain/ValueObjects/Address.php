<?php
declare(strict_types=1);
namespace Yummi\Domain\ValueObjects;

use Doctrine\ORM\Mapping as ORM;
use RuntimeException;

/**
 * Class Address
 * @package Yummi\Domain\ValueObjects
 * @ORM\Embeddable
 */
class Address
{
    /**
     * @var string|null
     * @ORM\Column (name="street", type="string", length=80)
     */
    private ?string $street;

    /**
     * @var string|null
     * @ORM\Column (name="number", type="string", length=5)
     */
    private ?string $number;

    /**
     * @var string|null
     * @ORM\Column (name="town", length=30)
     */
    private ?string $town;

    public function __construct(?string $street, ?string $number, ?string $town)
    {
        $this->town = $town;
        $this->street = $street;
        $this->number = $number;
        if ($this->validate()){
            throw new RuntimeException("Your address isn't valid.");
        }
    }

    public function validate() : bool
    {
        return !(empty($this->street) || empty($this->number) || empty($this->town) || strlen($this->town) > 30 || strlen($this->number) > 5 || strlen($this->street) > 80);
    }

    public function getTown() : ?string
    {
        return $this->town;
    }

    public function getStreet() : ?string
    {
        return $this->street;
    }

    public function getNumber() : ?string
    {
        return $this->number;
    }
}