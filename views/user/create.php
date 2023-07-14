<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserDB $model */

$this->title = Yii::t('user', 'Add User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-db-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
