<?php

namespace App\Message;

final readonly class UserCreatedMessage
{
    public function __construct(private array $userData)
    {
    }

    public function getUserData(): array
    {
        return $this->userData;
    }

}
