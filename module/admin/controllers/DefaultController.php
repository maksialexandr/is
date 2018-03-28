<?php

namespace app\module\admin\controllers;

use app\models\News;
use Yii;
use yii\base\Model;
use app\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class DefaultController extends Controller
{

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
