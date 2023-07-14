<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var app\models\ProjectSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="project-search">

    <?php $form = ActiveForm::begin([
        'id' => 'projectSearchForm',
        'action' => Url::to(['project/index']),
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
        ],
    ]); ?>

    <div class="row mb-3">
        <div class="col-md-4">
            <?= $form->field($model, 'id')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'text')->label(Yii::t('project', 'text')) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'added_date')->textInput(['type' => 'date']) ?>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('project', 'Search'), ['class' => 'btn btn-primary']) ?>
                <?= Html::Button(Yii::t('project', 'Reset'), ['id' => 'projectSearchReset','class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
