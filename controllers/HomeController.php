<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class HomeController extends Controller
{

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}