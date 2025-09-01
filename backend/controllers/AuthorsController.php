<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\models\AuthorSearch;
use common\models\Author;
use common\models\Book;
use common\models\forms\AuthorForm;
use common\repositories\AuthorRepository;
use common\services\AuthorService;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class AuthorsController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly AuthorRepository $repository,
        private readonly AuthorService $service,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'view', 'delete', 'subscribe', 'unsubscribe'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                    [
                        'actions' => ['index', 'view', 'subscribe', 'unsubscribe'],
                        'allow' => true,
                        'roles' => ['guest'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $searchModel = new AuthorSearch();
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
        $form = new AuthorForm();

        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request->post();

            if ($form->load($request) && $form->validate()) {
                $this->service->create($form);

                return $this->redirect('index');
            }
        }

        return $this->render('create', [
            'model' => $form
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
        $form = new AuthorForm();
        /** @var Author|null $model */
        $model = $this->repository->get($id);
        $form->setAttributes($model->attributes);
        $form->id = $model->id;

        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request->post();

            if ($form->load($request) && $form->validate()) {
                $form->id = $id;
                $this->service->update($form, $model);

                return $this->redirect('index');
            }
        }

        return $this->render('update', [
            'model' => $form
        ]);
    }

    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionDelete(int $id): Response
    {
        /** @var Author|null $author */
        if ($author = $this->repository->get($id)) {
            $this->service->delete($author);

            return $this->redirect('index');
        }

        throw new NotFoundHttpException('Автор не найден');
    }

    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->repository->get($id)
        ]);
    }

    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionSubscribe(int $id): Response
    {
        [$user, $author] = $this->prepareUserAndAuthorsModels($id);
        $this->service->subscribeUserToAuthor($user, $author);

        return $this->redirect('index');
    }

    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionUnsubscribe(int $id): Response
    {
        [$user, $author] = $this->prepareUserAndAuthorsModels($id);
        $this->service->unsubscribeUserToAuthor($user, $author);

        return $this->redirect('index');
    }

    private function prepareUserAndAuthorsModels(int $authorId): array
    {
        $user = Yii::$app->user->identity;
        /** @var Author $author */
        $author = $this->repository->get($authorId);

        if (!$author || !$user) {
            throw new NotFoundHttpException("Не удалось найти пользователя или автора!");
        }

        return [$user, $author];
    }
}