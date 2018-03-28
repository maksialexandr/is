<?php

namespace app\module\admin\controllers;

use app\models\News;
use app\models\TagSearch;
use Yii;
use yii\base\Model;
use app\models\NewsSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class DefaultController extends Controller
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
     * @param $searchModel
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


}
