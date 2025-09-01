<?php

declare(strict_types=1);

namespace common\providers\smsPilot\dto;

use Yii;
use yii\base\Model;

class SmsPilotRequestDto extends Model
{
    const API_PATH = 'api.php';

    public string $apikey;

    public string $send;

    public string $to;

    public string $format;

    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->apikey = (string)Yii::$app->params['smsPilot']['apikey'] ?? '';
    }

    public function rules(): array
    {
        return [
            [['to', 'phone'], 'required'],
            [['phone'], 'match', 'pattern' => '/^7[\d]{10}$/'],
        ];
    }

    public function fields(): array
    {
        return [
            'apikey',
            'send',
            'to',
            'format',
        ];
    }

    public function getFullUrl(string $path): string
    {
        $baseUrl = (string)Yii::$app->params['smsPilot']['url'];

        return "$baseUrl/$path";
    }
}