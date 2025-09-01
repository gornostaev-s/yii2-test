<?php

declare(strict_types=1);

namespace common\providers\smsPilot;

use common\providers\smsPilot\dto\SmsPilotRequestDto;
use yii\helpers\Json;
use yii\httpclient\Client;
use yii\httpclient\Request;

class SmsPilotHttpClient
{
    public function __construct(
        private readonly Client $client,
        private readonly Request $request,
    )
    {
    }

    public function sendMessage(SmsPilotRequestDto $dto): bool
    {
        $data = $dto->toArray();
        $this->request->setUrl($dto->getFullUrl(SmsPilotRequestDto::API_PATH) . '?' . http_build_query($data));
        $res = $this->client->send($this->request);


        $data = Json::decode($res);
        $status = $data['send'][0]['status'] ?? false;

        if ($status === '0') {
            return true;
        }

        return false;
    }
}