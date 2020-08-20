<?php
declare(strict_types=1);
namespace Yummi\Domain\ValueObjects;

use Doctrine\ORM\Mapping as ORM;
use RuntimeException;
/**
 * Class Email
 * @package Yummi\Domain\ValueObjects
 * @ORM\Embeddable
 */
class Email
{
    /**
     * @var string
     * @ORM\Column (name="email", type="string", length=80)
     */
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
        if (!$this->validate()){
            throw new RuntimeException("Your email isn't valid.");
        }
    }

    public function validate(): bool
    {
        return !(strlen($this->email)< 8 || strlen($this->email) > 80 || !filter_var($this->email, FILTER_VALIDATE_EMAIL));
    }

    public function getEmail() : string
    {
        return $this->email;
    }
}