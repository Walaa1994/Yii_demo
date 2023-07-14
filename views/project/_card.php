<?php

use app\models\Project;
use yii\bootstrap5\Html;
use yii\helpers\Url;

?>
<!-- Card with header and footer -->

<div class="card">
    <div class="card-header"><?= $model->title ?></div>
    <div class="card-body">
        <?= $model->projetc_descrption ?>
    </div>
    <div class="card-footer d-flex justify-content-center">
        <?= Html::button(Html::tag('i', '', ['class' => 'bi bi-eye']),
            ['class' => 'btn btn-primary me-1 openModal',
                'title' => Yii::t('project', 'View'),
                'data-url' => Url::to(['project/view','id' => $model->id]),
                'data-modal-title' => $model->title,
            ],
        ) ?>
        <?= Html::button(Html::tag('i', '', ['class' => 'bi bi-pencil']),
            ['class' => 'btn btn-success me-1 openModal',
                'title' => Yii::t('project', 'Update'),
                'data-url' => Url::to(['project/update','id' => $model->id]),
                'data-modal-title' => Yii::t('project', 'Update Project'),
            ],
        ) ?>
        <?= Html::button(Html::tag('i', '', ['class' => 'bi bi-trash']),
            ['class' => 'btn btn-danger me-1 deleteButton',
                'title' => Yii::t('project', 'Delete'),
                'data-url' => Url::to(['project/delete','id' => $model->id]),
                'data-pjax' => 'projects',
                'data-title' => Yii::t('project', 'Delete Project'),
                'data-text' => Yii::t('project', 'Are you sure that you want to delete this project?'),
                'data-confirmation' => Yii::t('project', 'Delete'),
                'data-cancelation' => Yii::t('project', 'Cancel'),
                'data-success' => Yii::t('project', 'Ok'),
            ]
        ) ?>
        <?= Html::button(Html::tag('i', '', ['class' => ($model->status == Project::ACTIVE_STATUS)?'bi bi-pause':'bi bi-play']),
            ['class' => 'btn btn-warning me-1 switchStatusButton',
                'title' => ($model->status == Project::INACTIVE_STATUS) ? Yii::t('project', 'Activate') : Yii::t('project', 'Deactivate'),
                'data-url' => Url::to(['project/switch-status','id' => $model->id]),
                'data-pjax' => 'projects',
                'data-title' => (($model->status == Project::INACTIVE_STATUS) ? Yii::t('project', 'Activate Project') : Yii::t('project', 'Deactivate Project')),
                'data-text' => Yii::t('project', 'Are you sure you want to ' . (($model->status == Project::INACTIVE_STATUS) ? 'activate' : 'deactivate') . ' this project?'),
                'data-confirmation' => Yii::t('project', 'Confirm'),
                'data-cancelation' => Yii::t('project', 'Cancel'),
                'data-success' => Yii::t('project', 'Ok'),
            ]
        ) ?>
    </div>
</div>

<!-- End Card with header and footer -->


