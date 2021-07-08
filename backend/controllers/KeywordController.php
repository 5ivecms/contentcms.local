<?php

namespace backend\controllers;

use common\components\GenerateArticles;
use common\components\GeneratedArticlesUtils;
use common\components\ImageUploader;
use common\models\Article;
use common\models\Setting;
use common\models\Timer;
use common\models\Tools;
use Curl\Curl;
use Yii;
use common\models\Keyword;
use common\models\KeywordSearch;
use yii\helpers\StringHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KeywordController implements the CRUD actions for Keyword model.
 */
class KeywordController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Keyword models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KeywordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Keyword model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Keyword model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Keyword();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateList()
    {
        $model = new Keyword();

        $post = Yii::$app->request->post();
        if ($post) {
            Timer::start();

            $modelName = StringHelper::basename(get_class($model));
            $list = $post[$modelName]['list'];
            $list = explode(PHP_EOL, $list);
            $list = array_unique($list);

            $rows = [];
            foreach ($list as $item) {
                $currentModel = new Keyword();
                $currentModel->keyword = $item;
                $currentModel->is_completed = Keyword::IS_NOT_COMPLETED_STATUS;
                $currentModel->is_failed = Keyword::IS_NOT_FAILED_STATUS;
                if (!$currentModel->validate()) {
                    continue;
                }
                $rows[] = $currentModel->attributes;
            }

            Yii::$app->db->createCommand()->batchInsert(Keyword::tableName(), $model->attributes(), $rows)->execute();

            Yii::$app->session->setFlash('success', 'Ключевые фразы добавлены. Время добавления ' . Timer::finish() . 'сек.');

            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing Keyword model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Keyword model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteSelected()
    {
        if (!isset($_POST['ids'])) {
            return $this->redirect(['proxy/index']);
        }

        $keywords = Keyword::find()->where(['id' => $_POST['ids']])->all();
        foreach ($keywords as $keyword) {
            $keyword->delete();
        }

        Yii::$app->session->setFlash('success', 'Выбранные ключевые фразы удалены');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Keyword model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Keyword the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Keyword::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionParseSelected()
    {
        if (!isset($_POST['ids'])) {
            Yii::$app->session->setFlash('danger', 'Нет выбранных');
            return $this->redirect(['index']);
        }

        Timer::start();

        $ids = $_POST['ids'];
        $keywords = Keyword::find()->where(['id' => $ids])->all();

        $generateArticles = new GenerateArticles();
        $generateArticles->setKeywords($keywords);
        $generateArticles->generate();

        if (count($generateArticles->getErrors())) {
            Yii::$app->session->setFlash('danger', implode(PHP_EOL, $generateArticles->getErrors()));
        } else {
            Yii::$app->session->setFlash('success', 'Ключевые фразы обработаны. Время выполнения ' . Timer::finish() . ' сек.');
        }

        return $this->redirect(['index']);
    }
}
