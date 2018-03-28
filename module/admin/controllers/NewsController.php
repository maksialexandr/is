<?php

namespace app\module\admin\controllers;

use app\models\Tag;
use app\models\UploadImage;
use Faker\Provider\DateTime;
use Yii;
use app\models\News;
use app\models\NewsSearch;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends DefaultController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index'     => ['GET'],
                    'create'    => ['GET', 'POST'],
                    'update'    => ['GET', 'POST', 'PUT'],
                    'delete'    => ['POST', 'DELETE'],
                    'view'      => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post()))
            if($this->saveOrUpdate($model))
                return $this->redirect(['view', 'id' => $model->id]);


        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldImage = $model->image;

        if ($model->load(Yii::$app->request->post()))
            if($this->saveOrUpdate($model)) {
                UploadImage::deleteOldImage($oldImage);
                return $this->redirect(['view', 'id' => $model->id]);
            }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $model
     * @return bool
     */
    protected function saveOrUpdate(News $model)
    {
        $modelImg = new UploadImage();

        if ($modelImg->image = UploadedFile::getInstance($model, 'image'))
            if ($imagePath = $modelImg->upload())
                $model->image = $imagePath;

        if (!$model->hasDate())
            $model->date = new Expression('NOW()');

        if($model->validate() && $model->save()) {
            if ($tags = ArrayHelper::getValue(Yii::$app->request->post(), 'News.tags'))
                $model->setTags($tags);

            return true;
        }

        return false;
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        UploadImage::deleteOldImage($model->image);

        //return $this->redirect(Yii::$app->request->referrer);
        return $this->redirect('index');
    }

    /**
     * @param Model $model
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
