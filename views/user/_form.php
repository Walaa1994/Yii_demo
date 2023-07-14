<?php

use app\models\UserDB;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\UserDB $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-db-form">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'fisrt_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'password')->passwordInput(['type' => 'password', 'value' => '', 'maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'birthday')->textInput(['type' => 'date','maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'gender')->dropDownList([
                '' => Yii::t('user', 'Please choose'),
                UserDB::MALE_GENDER => Yii::t('user', UserDB::GENDER[UserDB::MALE_GENDER]),
                UserDB::FEMALE_GENDER => Yii::t('user', UserDB::GENDER[UserDB::FEMALE_GENDER]),
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'permission')->dropDownList([
                UserDB::ADMIN_PERMISSION => Yii::t('user', UserDB::PERMISSION[UserDB::ADMIN_PERMISSION]),
                UserDB::USER_PERMISSION => Yii::t('user', UserDB::PERMISSION[UserDB::USER_PERMISSION]),
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'photo')->fileInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
