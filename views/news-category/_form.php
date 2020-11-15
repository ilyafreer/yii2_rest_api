<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\NewsCategory;

/* @var $this yii\web\View */
/* @var $model app\models\NewsCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=  $form->field($model, 'parent_id')->dropDownList(
        ArrayHelper::map(NewsCategory::find()->all(), 'id','title'),
        [
            'prompt' => 'Выбор категории новости',
        ]
    ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
