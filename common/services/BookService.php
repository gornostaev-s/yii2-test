<?php

declare(strict_types=1);

namespace common\services;

use common\models\Book;
use common\models\forms\BookForm;
use common\repositories\AuthorRepository;
use common\repositories\BookRepository;
use Throwable;
use yii\db\Exception;
use yii\web\UploadedFile;

class BookService
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly AuthorRepository $authorRepository,
        private readonly BookRepository $bookRepository,
        private readonly ImageService $imageService,
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
            $this->bookRepository->save($model);
            $this->linkAuthors($model, $form->author_ids);

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
            $this->updateImage($form);
            $model->unlinkAll('authors', true);
            $model->setAttributes($form->attributes);
            $this->linkAuthors($model, $form->author_ids);
            $this->bookRepository->save($model);

            return $model;
        });
    }

    public function delete(Book $model)
    {
        return $this->transactionService->wrap(function () use ($model) {
            $model->unlinkAll('authors', true);
            $this->bookRepository->delete($model);

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

    /**
     * @param BookForm $form
     * @return void
     * @throws \yii\base\Exception
     */
    private function updateImage(BookForm $form): void
    {
        if ($fileInstance = UploadedFile::getInstance($form, 'image_file')) {
            $filePath = $this->imageService->saveCoverImage($fileInstance);
            $form->image_url = $filePath;
        }
    }
}