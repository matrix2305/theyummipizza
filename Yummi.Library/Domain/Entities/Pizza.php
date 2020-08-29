<?php
declare(strict_types=1);
namespace Yummi\Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
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
     * @ORM\GeneratedValue(strategy="CUSTOM")
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
     * @ORM\Column(name="created_at", type="datetime")
     */
    private DateTime $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type = "datetime")
     */
    private DateTime $updatedAt;
    
    /**
     * @var
     * @ORM\OneToMany(targetEntity="Price", mappedBy="Pizza", fetch="EAGER", cascade={"remove", "persist"})
     */
    private $prices;

    /**
     * @var int
     *@ORM\Column(name="row_version", type="integer", length=8)
     */
    private int $rowVersion;

    public function __construct(){
        $this->prices = new ArrayCollection();
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
        return $this->prices;
    }

    public function setPrice(Price $price) : void
    {
        $this->prices->add($price);
    }

    public function clear() : void
    {
        $this->prices->clear();
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

    public function setRowVersion(): void
    {

        $this->rowVersion = random_int(1000, 1000000);
    }

    public function getRowVersion() : int
    {
        return $this->rowVersion;
    }
}