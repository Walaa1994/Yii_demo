<?php

use app\models\UserDB;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\UserDBSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-db-search">

    <?php $form = ActiveForm::begin([
        'id' => 'userSearchForm',
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row mb-3">
        <div class="col-md-3">
            <?= $form->field($model, 'id')->textInput(['type' => 'number'])->label(Yii::t('user', 'ID')) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'username')->label(Yii::t('user', 'Username')) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'email')->label(Yii::t('user', 'Email')) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList([
                '' => Yii::t('user', 'Please choose'),
                UserDB::ACTIVE_STATUS => Yii::t('user', UserDB::STATUS[UserDB::ACTIVE_STATUS]),
                UserDB::INACTIVE_STATUS => Yii::t('user', UserDB::STATUS[UserDB::INACTIVE_STATUS]),
            ])->label(Yii::t('user', 'Status')) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('user', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::Button(Yii::t('user', 'Reset'), ['id' => 'userSearchReset','class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
