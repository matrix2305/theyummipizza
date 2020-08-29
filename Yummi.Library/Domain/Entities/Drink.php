<?php
declare(strict_types=1);
namespace Yummi\Domain\Entities;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Yummi\Domain\IEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use DateTime;
/**
 * Class Drink
 * @package Yummi\Domain\Entities
 * @ORM\Entity
 * @ORM\Table (name="drinks")
 */
class Drink implements IEntity
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
     * @ORM\Column (name="name", type="string", length=20)
     */
    private string $name;

    /**
     * @var int
     * @ORM\Column (name="price", type="integer", length=10)
     */
    private int $price;

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
     * @var
     * @ORM\ManyToMany (targetEntity="Order", inversedBy="Drink", fetch="LAZY")
     */
    private $orders;

    /**
     * @var int
     *@ORM\Version
     *@ORM\Column(name="row_version", type="integer", length=8)
     */
    private int $rowVersion;

    public function __construct(){
        $this->orders = new ArrayCollection();
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getImagePath(): string
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
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return ArrayCollection
     */
    public function getOrders(): ArrayCollection
    {
        return $this->orders;
    }

    public function setOrders(Order $order) : void
    {
        $this->orders->add($order);
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