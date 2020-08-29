<?php
declare(strict_types=1);
namespace Yummi\Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Yummi\Domain\IEntity;
use Yummi\Domain\ValueObjects\Address;
use Yummi\Domain\ValueObjects\Email;
use Yummi\Domain\ValueObjects\Phone;
use RuntimeException;
use Gedmo\Mapping\Annotation as Gedmo;
use DateTime;
/**
 * Class Order
 * @package Yummi\Domain\Entities
 * @ORM\Entity
 * @ORM\Table (name="orders")
 */
class Order implements IEntity
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
     * @var int|null
     * @ORM\Column (name="price", type="integer", length=10)
     */
    private ?int $price;

    /**
     * @var Phone
     * @ORM\Embedded(class="Yummi\Domain\ValueObjects\Phone")
     */
    private Phone $phone;

    /**
     * @var Email
     * @ORM\Embedded(class="Yummi\Domain\ValueObjects\Email")
     */
    private Email $email;

    /**
     * @var string
     * @ORM\Column (name="name", type="string", length=40)
     */
    private string $name;

    /**
     * @var string
     * @ORM\Column (name="last_name", type="string", length=80)
     */
    private string $lastName;

    /**
     * @var Address
     * @ORM\Embedded (class="Yummi\Domain\ValueObjects\Address")
     */
    private Address $address;


    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name = "created_at", type="datetime")
     */
    private DateTime $createdAt;

    /**
     * @ORM\Version
     * @ORM\Column(name = "updated_at", type = "datetime")
     */
    private DateTime $updatedAt;

    /**
     * @var
     * @ORM\ManyToMany (targetEntity="Salad", mappedBy="Order", fetch="EAGER")
     */
    private $salads;

    /**
     * @var
     * @ORM\ManyToMany (targetEntity="Drink", mappedBy="Order", fetch="EAGER")
     */
    private $drinks;

    /**
     * @var
     * @ORM\OneToMany (targetEntity="OrderPizzaSideDishes", mappedBy="Order", fetch="EAGER")
     */
    private $ordersPizzasSideDishes;


    public function __construct()
    {
        $this->price = null;
        $this->salads = new ArrayCollection();
        $this->drinks = new ArrayCollection();
        $this->ordersPizzasSideDishes = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setPrice(): void
    {
        $total = 0;
        if (count($this->ordersPizzasSideDishes->toArray())>0){
            foreach ($this->ordersPizzasSideDishes->toArray() as $pizza){
                $total += $pizza->getPrice()->getPrice();
            }
        }
        if (count($this->salads->toArray()) > 0) {
            foreach ($this->salads->toArray() as $salad) {
                $total += $salad->getPrice();
            }
        }

        if (count($this->drinks->toArray()) > 0) {
            foreach ($this->drinks->toArray() as $drink) {
                $total += $drink->getPrice();
            }
        }

        if ($total === 0) {
            throw new RuntimeException("You aren't selected no one product, please select product.");
        }

        $this->price = $total;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setPhone(Phone $phone): void
    {
        $this->phone = $phone;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function setSalads(Salad $salad): void
    {
        $this->salads->add($salad);
    }

    public function getSalads(): ArrayCollection
    {
        return $this->salads;
    }

    public function setDrinks(Drink $drink): void
    {
        $this->drinks->add($drink);
    }

    public function getDrinks(): ArrayCollection
    {
        return $this->drinks;
    }


    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }


    public function clear() : void
    {
        $this->drinks->clear();
        $this->salads->clear();
        $this->ordersPizzasSideDishes->clear();
    }
}