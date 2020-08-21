<?php
declare(strict_types=1);
namespace Yummi\Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Yummi\Domain\IAggregate;
use Gedmo\Mapping\Annotation as Gedmo;
use DateTime;
/**
 * Class SideDish
 * @package Yummi\Domain\Entities
 * @ORM\Entity
 * @ORM\Table (name="side_dishes")
 */
class SideDish implements IAggregate
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
     * @var string
     * @ORM\Column (name="name", type="string", unique=true, length=30)
     */
    private string $name;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Version
     * @ORM\Column(name="updated_at",type="datetime")
     */
    private DateTime $updatedAt;


    /**
     * @var ArrayCollection
     * @ORM\ManyToMany (targetEntity="Price", inversedBy="SideDish", fetch="LAZY")
     */
    private ArrayCollection $pizzas;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany (targetEntity="OrderSideDishPizza", mappedBy="SideDish", fetch="EXTRA_LAZY")
     */
    private ArrayCollection $orderSideDishPizza;

    public function __construct(){
        $this->pizzas = new ArrayCollection();
        $this->orderSideDishPizza = new ArrayCollection();
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return ArrayCollection
     */
    public function getPizzas(): ArrayCollection
    {
        return $this->pizzas;
    }

    /**
     * @param Price $price
     */
    public function setPizzaPrice(Price $price): void
    {
        $this->pizzas->add($price);
    }

}