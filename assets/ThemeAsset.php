<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ThemeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/apexcharts.min.js',
        'js/bootstrap.bundle.min.js',
        'js/chart.umd.js',
        'js/echarts.min.js',
        'js/quill.min.js',
        'js/simple-datatables.js',
        'js/tinymce.min.js',
        'js/validate.js',
        'js/main.js',
        'js/sweetalert2.min.js',
        'js/custom.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

    public function registerAssetFiles($view)
    {
        parent::registerAssetFiles($view);

        // Register additional asset files
        $view->registerLinkTag(['href' => 'https://fonts.gstatic.com', 'rel' => 'preconnect'], 'EnglishThemeAsset');
        $view->registerCssFile('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i');
        $view->registerCssFile('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i');

    }
}
