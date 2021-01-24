<?php

declare(strict_types=1);

namespace App\Models;

class User
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $email = null;
    public ?string $password = null;
    public ?string $remember_token = null;
    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function setPassword(string $password): self
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}
