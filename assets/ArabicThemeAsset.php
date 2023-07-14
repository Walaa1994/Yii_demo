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
class ArabicThemeAsset extends ThemeAsset
{
    public $css = [
        'css/ar/bootstrap.rtl.css',
        'css/ar/bootstrap-icons.rtl.css',
        'css/ar/boxicons.min.rtl.css',
        'css/ar/quill.snow.rtl.css',
        'css/ar/quill.bubble.rtl.css',
        'css/ar/remixicon.rtl.css',
        'css/ar/style.rtl.css',
        'css/ar/main/style.rtl.css',
        'css/ar/sweetalert2.min.rtl.css'
    ];

    public $js = [
        'js/bootstrap.bundle.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\ThemeAsset'
    ];
}
