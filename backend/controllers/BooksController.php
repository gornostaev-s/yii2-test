<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\models\BookSearch;
use common\models\Author;
use common\models\Book;
use common\models\forms\BookForm;
use common\repositories\AuthorRepository;
use common\repositories\BookRepository;
use common\services\BookService;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class BooksController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly BookRepository $bookRepository,
        private readonly AuthorRepository $authorRepository,
        private readonly BookService $service,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['guest'],
                    ],
                ],
            ],
        ];
    }

    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->bookRepository->get($id)
        ]);
    }

    public function actionIndex(): string
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * @return Response|string
     * @throws Exception
     * @throws Throwable
     */
    public function actionCreate(): Response|string
    {
        $form = new BookForm();

        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request->post();

            if ($form->load($request) && $form->validate()) {
                $this->service->create($form);

                return $this->redirect('index');
            }
        }

        return $this->render('create', [
            'model' => $form,
            'authors' => $this->authorRepository->findAll(),
        ]);
    }

    /**
     * @param int $id
     * @return Response|string
     * @throws Throwable
     * @throws Exception
     */
    public function actionUpdate(int $id): Response|string
    {
        $form = new BookForm();

        /** @var Book|null $model */
        $model = $this->bookRepository->get($id);
        $form->setAttributes($model->attributes);
        $form->author_ids = array_map(static function (Author $author) {
            return $author->id;
        }, $model->authors);


        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request->post();

            if ($form->load($request) && $form->validate()) {
                $form->id = $id;
                $this->service->update($form, $model);

                return $this->redirect('index');
            }
        }

        return $this->render('update', [
            'model' => $form,
            'authors' => $this->authorRepository->findAll(),
        ]);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionDelete(int $id): mixed
    {
        /** @var Book|null $book */
        if ($book = $this->bookRepository->get($id)) {
            $this->service->delete($book);

            return $this->redirect('index');
        }

        throw new NotFoundHttpException('Книга не найдена');
    }
}