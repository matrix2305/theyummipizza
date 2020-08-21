<?php
declare(strict_types=1);
namespace Yummi\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;
use Yummi\Domain\IAggregate;

/**
 * Class OrderSideDishPizza
 * @package Yummi\Domain\Entities
 * @ORM\Entity
 * @ORM\Table (name="order_side_dish_pizza")
 */
class OrderSideDishPizza implements IAggregate
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
     * @var SideDish
     * @ORM\ManyToOne (targetEntity="SideDish", inversedBy="OrderSideDishPizza", fetch="EAGER")
     */
    private SideDish $sideDish;

    /**
     * @var Pizza
     * @ORM\ManyToOne (targetEntity="Pizza", inversedBy="OrderSideDishPizza", fetch="EAGER")
     */
    private Pizza $pizza;

    /**
     * @var Order
     * @ORM\ManyToOne (targetEntity="Order", inversedBy="OrderSideDishPizza", fetch="EXTRA_LAZY")
     */
    private Order $order;

    public function getId() : string
    {
        return $this->id;
    }

    public function setSideDish(SideDish $sideDish) : void
    {
        $this->sideDish = $sideDish;
    }

    public function getSideDish() : SideDish
    {
        return $this->sideDish;
    }

    public function setOrder(Order $order) : void
    {
        $this->order = $order;
    }

    public function getOrder() : Order
    {
        return $this->order;
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