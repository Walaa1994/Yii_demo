<?php

use yii\widgets\DetailView;

?>

<div class="project-view">
    <p>
        <?= $model->projetc_descrption ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'added_date',
            [
                'attribute' => 'added_by',
                'value' => function ($model) {
                    return $model->user->fisrt_name . ' ' . $model->user->last_name;
                },
            ],
        ],
    ]) ?>
</div>
