<?php
declare(strict_types=1);
namespace Yummi\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;
use Yummi\Domain\IEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use DateTime;
use Yummi\Domain\ValueObjects\Address;
use Yummi\Domain\ValueObjects\Email;
use Yummi\Domain\ValueObjects\Phone;
/**
 * Class ContentModel
 * @package Yummi\Domain\Entities
 * @ORM\Entity
 * @ORM\Table (name="content")
 */
class Content implements IEntity
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
     * @ORM\Column (name="description", type="text")
     */
    private string $description;

    /**
     * @var Email
     * @ORM\Embedded (class="Yummi\Domain\ValueObjects\Email")
     */
    private Email $email;

    /**
     * @var Phone
     * @ORM\Embedded (class="Yummi\Domain\ValueObjects\Phone")
     */
    private Phone $phone;

    /**
     * @var Address
     * @ORM\Embedded (class="Yummi\Domain\ValueObjects\Address")
     */
    private Address $address;
    /**
     * @Gedmo\Timestampable (on="update")
     * @ORM\Version
     * @ORM\Column(name = "updated_at", type = "datetime")
     */
    private DateTime $updatedAt;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @param Email $email
     */
    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    /**
     * @return Phone
     */
    public function getPhone(): Phone
    {
        return $this->phone;
    }

    /**
     * @param Phone $phone
     */
    public function setPhone(Phone $phone): void
    {
        $this->phone = $phone;
    }


    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
}