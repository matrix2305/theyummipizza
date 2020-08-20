<?php
declare(strict_types=1);
namespace Yummi\Domain\Entities;


use Doctrine\ORM\Mapping as ORM;
use Yummi\Domain\IAggregate;
use Yummi\Domain\Enum\Size;
/**
 * Class Price
 * @package Yummi\Domain\Entities
 * @ORM\Entity
 * @ORM\Table (name="pizza_prices")
 */
class Price implements IAggregate
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="id", type="uuid", unique=true)
     * @ORM\GeneratedValue (strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private string $id;

    /**
     * @var Pizza
     * @ORM\ManyToOne (targetEntity="Pizza", inversedBy="Pizza", fetch="LAZY")
     */
    private Pizza $pizza;

    /**
     * @var int
     * @ORM\Column (name="price", type="integer", length=10)
     */
    private int $price;

    /**
     * @var Size
     * @ORM\Embedded (class="Yummi\Domain\Enum\Size")
     */
    private Size $size;

    public function getId() : string
    {
        return $this->id;
    }

    public function getPrice() : int
    {
        return $this->price;
    }

    public function setPrice(int $price) : void
    {
        $this->price = $price;
    }

    public function setSize(Size $size) : void
    {
        $this->size = $size;
    }

    public function getSize() : Size
    {
        return $this->size;
    }

    public function setPizza(Pizza $pizza) : void
    {
        $this->pizza = $pizza;
    }

    public function getPizza() : Pizza
    {
        return $this->pizza;
    }
}