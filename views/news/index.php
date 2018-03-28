<?php

use branchonline\lightbox\Lightbox;
use yii\helpers\Html;
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

<main role="main">
    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                <?php foreach ($dataProvider->getModels() as $model): ?>
                    <div class="col-md-8">
                        <div class="card mb-4 box-shadow">
                            <?= Html::tag('h3', Html::encode($model->name)); ?>
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
                            <div class="card-body">
                                <p class="card-text">
                                    <?= Html::tag('p', Html::encode($model->content)); ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <?php foreach ($model->tags as $tag)
                                        echo Html::tag('span', Html::encode($tag->name), ['class' => 'label-danger label pull-right']) . '<br />'
                                    ?>
                                    <div class="btn-group">
                                        <?= Html::a('View', '/news/view?id=' . $model->id, [
                                            'class' => 'btn btn-sm btn-info',
                                            'type' => 'button'
                                        ])?>
                                    </div>
                                    <?php  if ($model->hasDate())
                                        echo Html::tag('p', Html::encode($model->getDate()), ['class' => 'text-muted']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?= LinkPager::widget([
                'pagination' => $dataProvider->pagination,
            ])?>
        </div>
    </div>
</main>
