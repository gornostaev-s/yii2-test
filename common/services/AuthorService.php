<?php

declare(strict_types=1);

namespace common\services;

use common\models\Author;
use common\models\forms\AuthorForm;
use Exception;
use Throwable;

class AuthorService
{
    public function __construct(
        private readonly TransactionService $transactionService,
    )
    {
    }

    /**
     * @param AuthorForm $form
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function create(AuthorForm $form): mixed
    {
        return $this->transactionService->wrap(function () use ($form) {
            $model = new Author();
            $model->setAttributes($form->attributes);
            $model->save();

            return $model;
        });
    }

    /**
     * @param AuthorForm $form
     * @param Author $model
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function update(AuthorForm $form, Author $model): mixed
    {
        return $this->transactionService->wrap(function () use ($form, $model) {
            $model->setAttributes($form->attributes);
            $model->save();

            return $model;
        });
    }
}