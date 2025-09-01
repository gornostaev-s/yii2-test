<?php

declare(strict_types=1);

namespace common\jobs;

use common\interfaces\SendMessageInterface;
use Yii;
use yii\base\BaseObject;
use yii\queue\RetryableJobInterface;

class NotifySubscriberJob extends BaseObject implements RetryableJobInterface
{
    private const RETRY_COUNT = 1;

    private const TTR = 60;

    public int $phone;

    public string $text;

    public function execute($queue)
    {
        $client = Yii::$container->get(SendMessageInterface::class);
        $client->sendMessage($this->phone, $this->text);
    }

    public function canRetry($attempt, $error): bool
    {
        return $attempt <= self::RETRY_COUNT;
    }

    public function getTtr(): int
    {
        return self::TTR;
    }
}