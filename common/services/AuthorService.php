<?php

declare(strict_types=1);

namespace common\services;

use common\models\Author;
use common\models\forms\AuthorForm;
use common\repositories\AuthorRepository;
use Exception;
use Throwable;

class AuthorService
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly AuthorRepository $authorRepository,
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

    public function delete(Author $model)
    {
        return $this->transactionService->wrap(function () use ($model) {
            $this->authorRepository->delete($model);

            return $model;
        });
    }
}