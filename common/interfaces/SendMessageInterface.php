<?php

declare(strict_types=1);

namespace common\interfaces;

interface SendMessageInterface
{
    public function sendMessage(int $phone, ?string $text = null);
}