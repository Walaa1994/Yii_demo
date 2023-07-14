<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ProjectSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('project', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="project-index">
    <div class="d-flex justify-content-between mb-5">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::button(Yii::t('project', 'Create Project'), [
                'class' => 'btn btn-success openModal',
                'data-url' => Url::to(['project/create']),
                'data-modal-title' => Yii::t('project', 'Create Project'),
            ]) ?>
        </p>
    </div>

    <?php Pjax::begin(['id' => 'projects']); ?>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_card',
        'options' => ['class' => 'row'],
        'itemOptions' => ['class' => 'col-md-3'], // Add a class to each card item
        'layout' => "{items}\n{pager}",
        'pager' => [
            'class' => LinkPager::class,
            'options' => ['class' => 'pagination justify-content-center'], // Add Bootstrap class to the pagination container
            'prevPageLabel' => '&laquo;', // Customize previous page button label
            'nextPageLabel' => '&raquo;', // Customize next page button label
            'prevPageCssClass' => 'page-item', // Customize previous page button CSS class
            'nextPageCssClass' => 'page-item', // Customize next page button CSS class
            'linkOptions' => ['class' => 'page-link'], // Add Bootstrap class to the pagination links
            'activePageCssClass' => 'active', // Customize active page CSS class
            'disabledPageCssClass' => 'disabled', // Customize disabled page CSS class
        ],
    ]); ?>
    <?php Pjax::end(); ?>

    <?php  echo $this->render('_modal'); ?>
</div>



