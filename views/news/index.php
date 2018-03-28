<?php

use branchonline\lightbox\Lightbox;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
</div>

<?= $sort->link('date') ?>


<div class="container">
    <?php foreach ($dataProvider->getModels() as $model): ?>
        <div class="well">
            <div class="media">
                <div class="img-preview-in-detail">
                    <?= Lightbox::widget([
                        'files' => [
                            [
                                'thumb' => Yii::$app->homeUrl . $model->image,
                                'original' => Yii::$app->homeUrl . $model->image,
                            ],
                        ]
                    ]);?>
                </div>
                <div class="media-body">
                    <?= Html::tag('h3', Html::encode($model->name), ['class' => 'media-heading']); ?>
                    <?php foreach ($model->tags as $tag)
                        echo Html::tag('span', Html::encode($tag->name), ['class' => 'label label-danger']) ?>
                    <?= Html::tag('p', Html::encode($model->content)); ?>
                    <ul class="list-inline list-unstyled">
                        <li><span><i class="glyphicon glyphicon-calendar"></i>
                                <?= ($model->hasDate()) ? $model->getDate() : ''; ?>
                            </span>
                        </li>
                        <a class="btn btn-sm btn-default" href="<?= '/news/view?id=' . $model->id ?>">view</a>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?= LinkPager::widget([
        'pagination' => $dataProvider->pagination,
    ])?>
</div>