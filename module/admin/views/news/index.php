<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'content:ntext',
            [
                'attribute' => 'tags',
                'format' => 'html',
                'value' => function ($data) {
                    $html = '';
                    foreach ($data->tags as $tag){
                        $html .= '<p>' . $tag->name . '</p>';
                    }
                    return $html;
                },
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(Yii::$app->homeUrl .  $data['image'],
                        ['width' => '60px']);
                },
            ],
            [
                'attribute' => 'date',
                'value' => function ($data){
                    return ($data->hasDate()) ? $data->getDate() : '';
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
