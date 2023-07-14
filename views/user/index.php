<?php

use app\models\UserDB;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\UserDBSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('user', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-db-index">
    <div class="d-flex justify-content-between mb-5">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('user', 'Add User'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
    <?php Pjax::begin(['id' => 'users']); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'photo',
                'label' => Yii::t('user', 'Photo'),
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(Yii::getAlias('@web/img/users/'.$data->photo), ['width' => '75','height' => '75']);
                },
            ],
            [
                'attribute' => 'full_name',
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($data) {
                    return $data->fisrt_name .' '.$data->last_name; // $data['name'] for array data, e.g. using SqlDataProvider.
                },
            ],
            [
                'attribute' => 'status',
                'label' => Yii::t('user', 'Status'),
                'format' => 'html',
                'value' => function ($data) {
                    $statusLabel = $data->status == UserDB::ACTIVE_STATUS ? 'success' : 'danger';
                    return Html::tag('span', Yii::t('user',UserDB::STATUS[$data->status]) , ['class' => "badge bg-$statusLabel"]);
                },
            ],
            [
                'attribute' => 'permission',
                'label' => Yii::t('user', 'Permission'),
                'value' => function ($data) {
                    return UserDB::PERMISSION[$data->permission];
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UserDB $model, $key, $index, $column) {
                    if ($action === 'switch-status') {
                        return Url::to(['user/switch-status','id' => $model->id]);;
                    }
                    // Return the default action URLs for other actions (view, update, delete)
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'template' => '{view} {update} {delete} {switch-status}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a(Html::tag('i', '', ['class' => 'bi bi-eye']), $url, [
                            'title' => Yii::t('user', 'View'),
                            'class' => 'btn btn-primary',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a(Html::tag('i', '', ['class' => 'bi bi-pencil']), $url, [
                            'title' => Yii::t('user', 'Update'),
                            'class' => 'btn btn-success',
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::button(Html::tag('i', '', ['class' => 'bi bi-trash']), [
                            'title' => Yii::t('user', 'Delete'),
                            'class' => 'btn btn-danger deleteButton',
                            'data-url' => $url,
                            'data-pjax' => 'users',
                            'data-title' => Yii::t('user', 'Delete User'),
                            'data-text' => Yii::t('user', 'Are you sure you want to delete this user?'),
                            'data-confirmation' => Yii::t('user', 'Delete'),
                            'data-cancelation' => Yii::t('user', 'Cancel'),
                            'data-success' => Yii::t('user', 'Ok'),

                        ]);
                    },
                    'switch-status' => function ($url, $model, $key) {
                        return Html::button(Html::tag('i', '', ['class' => ($model->status == UserDB::ACTIVE_STATUS)?'bi bi-pause':'bi bi-play']), [
                            'title' => ($model->status == UserDB::INACTIVE_STATUS) ? Yii::t('user', 'Activate') : Yii::t('user', 'Deactivate'),
                            'class' => 'btn btn-warning switchStatusButton',
                            'data-url' => $url,
                            'data-pjax' => 'users',
                            'data-title' => (($model->status == UserDB::INACTIVE_STATUS) ? Yii::t('user', 'Activate User') : Yii::t('user', 'Deactivate User')),
                            'data-text' => Yii::t('user', 'Are you sure you want to ' . (($model->status == UserDB::INACTIVE_STATUS) ? 'activate' : 'deactivate') . ' this user?'),
                            'data-confirmation' => Yii::t('user', 'Confirm'),
                            'data-cancelation' => Yii::t('user', 'Cancel'),
                            'data-success' => Yii::t('user', 'Ok'),
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
