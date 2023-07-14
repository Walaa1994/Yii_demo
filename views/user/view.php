<?php

use app\models\UserDB;
use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\UserDB $model */

$this->title = $model->fisrt_name.' '.$model->last_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-db-view">
    <div class="card" style="margin-top: 100px;">
        <div class="position-relative">
            <img src="<?= Yii::getAlias('@web/img/users/'.$model->photo) ?>" height="150" width="150" alt="Profile" class="rounded-circle position-absolute top-0 start-50 translate-middle">
        </div>

        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center" style="margin-top: 100px;">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'full_name',
                        'value' => function ($model) {
                            return $model->fisrt_name . ' ' . $model->last_name;
                        },
                    ],
                    'username',
                    'email:email',
                    [
                        'attribute' => 'status',
                        'format' => 'html',
                        'value' => function ($data) {
                            $statusLabel = $data->status == UserDB::ACTIVE_STATUS ? 'success' : 'danger';
                            return Html::tag('span', Yii::t('user',UserDB::STATUS[$data->status]), ['class' => "badge bg-$statusLabel"]);
                        },
                    ],
                    [
                        'attribute' => 'gender',
                        'value' => function ($data) {
                            return Yii::t('user',UserDB::GENDER[$data->gender]) ;
                        },
                    ],
                    [
                        'attribute' => 'permission',
                        'format' => 'html',
                        'value' => function ($data) {
                            $statusLabel = $data->permission == UserDB::ADMIN_PERMISSION ? 'primary' : 'secondary';
                            return Html::tag('span', Yii::t('user',UserDB::PERMISSION[$data->permission]) , ['class' => "badge bg-$statusLabel"]);
                        },
                    ],
                    'birthday',
                    'added_date',
                    'last_update',
                ],
            ]) ?>
        </div>
    </div>
</div>
