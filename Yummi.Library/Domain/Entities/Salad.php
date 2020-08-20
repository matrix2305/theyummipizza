<?php
declare(strict_types=1);
namespace Yummi\Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Yummi\Domain\IEntity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use DateTime;
/**
 * Class Salad
 * @package Yummi\Domain\Entities
 * @ORM\Entity
 * @ORM\Table (name="salads")
 */
class Salad implements IEntity
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
     * @ORM\ManyToMany (targetEntity="Order", inversedBy="Salad", fetch="LAZY")
     */
    private ArrayCollection $orders;

    public function __construct(){
        $this->orders = new ArrayCollection();
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
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
}