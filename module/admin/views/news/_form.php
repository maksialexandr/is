<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= Html::img(Yii::$app->homeUrl .  $model->image,
        ['width' => '150']); ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= Html::label($model->getAttributeLabel('date'), null, ['class' => 'control-label']) ?>
    <?= DatePicker::widget([
        'model' => $model,
        'attribute' => 'date',
        'value' => date('Y-m-d'),
        'options' => ['placeholder' => 'Select issue date ...'],
        'pluginOptions' => [
            'format' => 'yyyy-m-d',
            'todayHighlight' => true
        ]
    ]);?>

    <?= $form->field($model, 'tags')->listBox($model->getAllTags(),['multiple' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
