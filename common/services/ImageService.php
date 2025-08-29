<?php

declare(strict_types=1);

namespace common\services;

use Yii;
use yii\base\Exception;
use yii\web\UploadedFile;

class ImageService
{
    /**
     * @param UploadedFile $fileInstance
     * @return string|null
     * @throws Exception
     */
    public function saveCoverImage(UploadedFile $fileInstance): ?string
    {
        $path = Yii::getAlias('@webroot/uploads/');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $filename = Yii::$app->security->generateRandomString() . '.' . $fileInstance->extension;
        $filepath = $path . $filename;

        return $fileInstance->saveAs($filepath) ? '/uploads/' . $filename : null;
    }
}