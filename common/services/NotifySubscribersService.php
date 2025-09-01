<?php

declare(strict_types=1);

namespace common\services;

use common\interfaces\SendMessageInterface;
use common\jobs\NotifySubscriberJob;
use common\models\Author;
use common\models\Book;
use common\models\User;
use Yii;

class NotifySubscribersService
{
    const TEXT_TEMPLATE = "Вышла новая книга! {title}";

    private function notifyUser(Book $book, User $user): void
    {
        Yii::$app->queueSubscribers->push(new NotifySubscriberJob([
            'phone' => (int)$user->phone,
            'text' => strtr(self::TEXT_TEMPLATE, [
                '{title}' => $book->title
            ]),
        ]));
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