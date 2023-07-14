<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\ArabicThemeAsset;
use app\widgets\HeaderNavWidget;
use app\widgets\SidebarNavWidget;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\helpers\Url;


ArabicThemeAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" dir="rtl">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- =======================================================
    * Template Name: NiceAdmin - v2.5.0
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>
<?php $this->beginBody() ?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="<?= Url::to('/site/index') ?>" class="logo d-flex align-items-center">
            <img src="<?= Yii::getAlias("@web/img/logo.png") ?>" alt="">
            <span class="d-none d-lg-block">NiceAdmin</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <?= HeaderNavWidget::widget([
        'items' => [
            [
                'label' => Yii::t('app',Yii::$app->params['languages'][Yii::$app->language]),
                'items' => [
                    [
                        'label' => Yii::t('app','Arabic') ,
                        'url' => '#',
                        'encode' => false,
                        'linkOptions' => ['class' => 'language','id' => 'ar'],
                    ],
                    [
                        'label' => Yii::t('app','English') ,
                        'url' => '#',
                        'encode' => false,
                        'linkOptions' => ['class' => 'language','id' => 'en'],
                    ],
                ],
            ],
            [
                'label' => Yii::$app->user->identity->username,
                'image' => Yii::getAlias('@web/img/profile-img.jpg') , // optional image URL
                'imageOptions' => ['class' => 'rounded-circle'], // optional image HTML options
                'items' => [
                    [
                        'label' => '<i class="bi bi-box-arrow-right"></i>'. Html::beginForm(Url::to(['/site/logout']))
                            . Html::submitButton(
                                Yii::t('app','Sign Out'),
                                ['class' => 'border-0 bg-transparent p-0 m-0 logout']
                            )
                            . Html::endForm() ,
                        'url' => '#',
                        'encode' => false,
                        'linkOptions' => ['class' => 'dropdown-item d-flex align-items-center'],
                    ],
                ],
            ],
        ],
    ]); ?>
</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<?= SidebarNavWidget::widget([
    'items' => [
        [
            'label' => Yii::t('app','Users Management'),
            'icon' => 'bi bi-layout-text-window-reverse',
            'url' => Url::to(['user/index']),
            'options' => ['class' => 'nav-item'],
            'linkOptions' => ['class' => 'nav-link collapsed']
        ],
        [
            'label' => Yii::t('app','Projects Management'),
            'icon' => 'bi bi-layout-text-window-reverse',
            'url' => Url::to(['project/index']),
            'options' => ['class' => 'nav-item'],
            'linkOptions' => ['class' => 'nav-link collapsed']
        ],
    ],
]) ?>
<!-- End Sidebar-->

<main id="main" class="main">

    <?php if (!empty($this->params['breadcrumbs'])): ?>
        <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
    <?php endif ?>
    <?php if(Yii::$app->session->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            <?= Yii::$app->session->getFlash('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
    <?= $content ?>



</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>

</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>