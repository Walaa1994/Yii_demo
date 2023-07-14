<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\UserDB $model */

$this->title = Yii::t('user', 'Update User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fisrt_name.' '.$model->last_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('user', 'Update User');
?>
<div class="user-db-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
