<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\ArabicThemeAsset;
use yii\bootstrap5\Html;

ArabicThemeAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge']);
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerMetaTag(['name' => 'author', 'content' => $this->params['meta_author'] ?? '']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title><?= Html::encode($this->title) ?></title>

    <!-- Favicons -->
    <link href= <?= Yii::getAlias("@web/img/favicon.png") ?> rel="icon">
    <link href= <?= Yii::getAlias("@web/img/apple-touch-icon.png") ?> rel="apple-touch-icon">


    <!-- =======================================================
    * Template Name: NiceAdmin - v2.5.0
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<main>
    <div class="container">
        <?= $content ?>
    </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>