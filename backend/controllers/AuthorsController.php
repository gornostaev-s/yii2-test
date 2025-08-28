<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\models\AuthorSearch;
use common\models\Author;
use common\models\forms\AuthorForm;
use common\repositories\AuthorRepository;
use common\services\AuthorService;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
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
                        'actions' => ['index', 'create', 'update'],
                        'allow' => true,
                        'roles' => ['user'],
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
}