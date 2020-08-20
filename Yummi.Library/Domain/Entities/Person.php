<?php
declare(strict_types=1);
namespace Yummi\Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Yummi\Domain\IAggregate;
use Yummi\Domain\ValueObjects\Address;
use Yummi\Domain\ValueObjects\Phone;

/**
 * Class Person
 * @package Yummi\Domain\Entities
 * @ORM\Entity
 * @ORM\Table (name="persons")
 */
class Person implements IAggregate
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
     * @ORM\Column (name="name", type="string", length=30)
     */
    private string $name;

    /**
     * @var string
     * @ORM\Column (name="last_name", type="string", length=50)
     */
    private string $lastName;

    /**
     * @var Address
     * @ORM\Embedded (class="Yummi\Domain\ValueObjects\Address")
     */
    private Address $address;

    /**
     * @var Phone
     * @ORM\Embedded (class="Yummi\Domain\ValueObjects\Phone")
     */
    private Phone $phone;

    /**
     * @var User
     * @ORM\OneToOne (targetEntity="User", mappedBy="Person", fetch="LAZY", cascade={"remove"})
     */
    private User $user;


    public function getId() : string
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function getLastName() : string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName) : void
    {
        $this->lastName = $lastName;
    }

    public function setAddress(Address $address) : void
    {
        $this->address = $address;
    }

    public function getAddress() : Address
    {
        return $this->address;
    }

    public function setPhone(Phone $phone) : void
    {
        $this->phone = $phone;
    }

    public function getPhone() : Phone
    {
        return $this->phone;
    }

    public function setUser(User $user) : void
    {
        $this->user = $user;
    }

    public function getUser() : User
    {
        return $this->user;
    }
}