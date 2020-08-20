<?php
declare(strict_types=1);
namespace Yummi\Domain\Entities;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use LaravelDoctrine\ORM\Notifications\Notifiable;
use LaravelDoctrine\ORM\Auth\Authenticatable as DoctrineAuth;
use Doctrine\ORM\Mapping as ORM;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Yummi\Domain\IEntity;
use Yummi\Domain\ValueObjects\Email;
use Gedmo\Mapping\Annotation as Gedmo;
use DateTime;
/**
 * Class User
 * @package Yummi\Domain\Entities
 * @ORM\Entity
 * @ORM\Table (name="users")
 */
class User implements Authenticatable, CanResetPasswordContract, JWTSubject, IEntity
{
    use DoctrineAuth, CanResetPassword, Notifiable;

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
     * @ORM\Column (name="username", type="string", length=30, unique=true)
     */
    private string $username;

    /**
     * @var string
     * @ORM\Column (name="email", type="string", length=80, unique=true)
     */
    private string $email;

    /**
     * @var string|null
     * @ORM\Column (name="avatar_path", type="string", length=20, nullable=true)
     */
    private ?string $avatarPath;

    /**
     * @var Person
     * @ORM\OneToOne(targetEntity="Person", inversedBy="User", fetch="EAGER")
     */
    private Person $person;

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

    public function __construct()
    {
        $this->avatarPath = null;
    }

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getKey() : string
    {
        return $this->getId();
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getUsername() : string
    {
        return $this->username;
    }

    public function setUsername(string $username) : void
    {
        $this->username = $username;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }

    public function getAvatarPath() : ?string
    {
        return $this->avatarPath;
    }

    public function setAvatarPath(?string $avatarPath) : void
    {
        $this->avatarPath = $avatarPath;
    }

    public function getPerson() : Person
    {
        return $this->person;
    }

    public function setPerson(Person $person) : void
    {
        $this->person = $person;
    }

    public function getUpdatedAt() : DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Method for get created at time
     * @return DateTime
     */
    public function getCreatedAt() : DateTime
    {
        return $this->createdAt;
    }
}