<?php
declare(strict_types=1);
namespace Yummi\Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Yummi\Domain\IAggregate;

/**
 * Class OrderSideDishPizza
 * @package Yummi\Domain\Entities
 * @ORM\Entity
 * @ORM\Table (name="order_pizza_side_dishes")
 */
class OrderPizzaSideDishes implements IAggregate
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
     * @var
     * @ORM\ManyToMany (targetEntity="SideDish", inversedBy="OrderPizzaSideDishes", fetch="EAGER")
     */
    private $sideDishes;

    /**
     * @var Price
     * @ORM\ManyToOne (targetEntity="Price", inversedBy="OrderPizzaSideDishes", fetch="EAGER")
     */
    private Price $price;

    /**
     * @var Order
     * @ORM\ManyToOne (targetEntity="Order", inversedBy="OrderPizzaSideDishes", fetch="LAZY")
     */
    private Order $order;

    public function __construct() {
        $this->sideDishes = new ArrayCollection();
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function setSideDish(SideDish $sideDish) : void
    {
        $this->sideDishes->add($sideDish);
    }

    public function getSideDish() : ArrayCollection
    {
        return $this->sideDishes;
    }

    public function setOrder(Order $order) : void
    {
        $this->order = $order;
    }

    public function getOrder() : Order
    {
        return $this->order;
    }

    public function setPrice(Price $price) : void
    {
        $this->price = $price;
    }

    public function getPizza() : Price
    {
        return $this->price;
    }
}