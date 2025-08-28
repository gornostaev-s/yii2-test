<?php

declare(strict_types=1);

namespace common\services;

use common\models\Author;
use common\models\Book;
use common\models\forms\BookForm;
use common\repositories\AuthorRepository;
use Throwable;
use yii\db\Exception;

class BookService
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly AuthorRepository $authorRepository,
    )
    {
    }

    /**
     * @param BookForm $form
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function create(BookForm $form): mixed
    {
        return $this->transactionService->wrap(function () use ($form) {
            $model = new Book();
            $model->setAttributes($form->attributes);
            $model->save();
            $model->link('authors', $this->authorRepository->get(1));

            return $model;
        });
    }

    /**
     * @param BookForm $form
     * @param Book $model
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function update(BookForm $form, Book $model): mixed
    {
        return $this->transactionService->wrap(function () use ($form, $model) {
            $model->unlinkAll('authors', true);
            $model->setAttributes($form->attributes);
            $this->linkAuthors($model, $form->author_ids);
            $model->save();

            return $model;
        });
    }

    private function linkAuthors(Book $book, array $authorIds): void
    {
        $book->unlinkAll('authors');

        foreach ($authorIds as $authorId) {

            $book->link('authors', $this->authorRepository->get((int)$authorId));
        }
    }
}