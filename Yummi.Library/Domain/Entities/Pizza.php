<?php
declare(strict_types=1);
namespace Yummi\Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Yummi\Domain\IEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use DateTime;
/**
 * Class Pizza
 * @package Yummi\Domain\Entities
 * @ORM\Entity
 * @ORM\Table (name="pizza")
 */
class Pizza implements IEntity
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
     * @ORM\Column (name="name", type="string", length=30, unique=true)
     */
    private string $name;

    /**
     * @var string
     * @ORM\Column (name="description", type="text")
     */
    private string $description;

    /**
     * @var string
     * @ORM\Column (name="image_path", type="string", length=50)
     */
    private string $imagePath;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name = "created_at", type="datetime")
     */
    private DateTime $createdAt;

    /**
     * @Gedmo\Timestampable (on="update")
     * @ORM\Version
     * @ORM\Column(name = "updated_at", type = "datetime")
     */
    private DateTime $updatedAt;


    /**
     * @var ArrayCollection
     * @ORM\OneToMany  (targetEntity="Price", mappedBy="Pizza", fetch="EAGER", cascade={"remove", "persist"})
     */
    private ArrayCollection $price;

    public function __construct(){
        $this->price = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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

    public function getPrice() : ArrayCollection
    {
        return $this->price;
    }

    public function setPrice(Price $price) : void
    {
        $this->price->add($price);
    }


    public function getImagePath() : string
    {
        return $this->imagePath;
    }

    /**
     * @param string $imagePath
     */
    public function setImagePath(string $imagePath): void
    {
        $this->imagePath = $imagePath;
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
        $this->price->clear();
    }
}