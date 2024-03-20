<?php

namespace App\MessageHandler;

use App\Message\UserCreatedMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class UserCreatedMessageHandler
{
    private string $logFilePath;

    public function __construct(string $logFilePath)
    {
        $this->logFilePath = $logFilePath;
    }

    public function __invoke(UserCreatedMessage $message): void
    {
        $userData = $message->getUserData();
        file_put_contents($this->logFilePath, json_encode($userData) . PHP_EOL, FILE_APPEND);
    }
}
