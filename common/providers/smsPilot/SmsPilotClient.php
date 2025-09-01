<?php

declare(strict_types=1);

namespace common\providers\smsPilot;

use common\interfaces\SendMessageInterface;
use common\providers\smsPilot\dto\SmsPilotRequestDto;

class SmsPilotClient implements SendMessageInterface
{
    const DEFAULT_MESSAGE = 'У автора появилась новая книга!';

    public function __construct(
        private readonly SmsPilotHttpClient $httpClient
    )
    {
    }

    public function sendMessage(int $phone, ?string $text = null): bool
    {
        $dto = new SmsPilotRequestDto([
            'send' => $text ?? self::DEFAULT_MESSAGE,
            'to' => $phone,
        ]);

        return $this->httpClient->sendMessage($dto);
    }
}