<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use branchonline\lightbox\Lightbox;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['/news']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="img-preview">
        <?= Lightbox::widget([
            'files' => [
                [
                    'thumb' => Yii::$app->homeUrl . $model->image,
                    'original' => Yii::$app->homeUrl . $model->image,
                ],
            ]
        ]);?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'content:ntext',
            [
                'attribute' => 'date',
                'value' => function ($data){
                    return $data->getDate();
                }
            ],
            [
                'attribute' => 'tags',
                'format' => 'html',
                'value' => function ($data) {
                    $html = '';
                    foreach ($data->tags as $tag){
                        $html .= '<span class="label label-default">' . $tag->name . '</span>';
                    }
                    return $html;
                },
            ],
        ],
    ]) ?>

</div>
