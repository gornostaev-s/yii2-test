<?php

declare(strict_types=1);

namespace common\services;

use common\interfaces\SendMessageInterface;
use common\models\Author;
use common\models\Book;
use common\models\User;

class NotifySubscribersService
{
    const TEXT_TEMPLATE = "Вышла новая книга! {title}";

    public function __construct(
        private readonly SendMessageInterface $client
    )
    {
    }

    private function notifyUser(Book $book, User $user): void
    {
        $text = strtr(self::TEXT_TEMPLATE, [
            '{title}' => $book->title
        ]);

        $this->client->sendMessage((int)$user->phone, $text);
    }

    public function sendByAuthor(Book $book, Author $author): void
    {
        foreach ($author->users as $user) {
            if ($user->phone) {
                $this->notifyUser($book, $user);
            }
        }
    }
}