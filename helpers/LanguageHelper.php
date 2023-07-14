<?php

namespace app\helpers;

use Yii;
use yii\web\Cookie;

class LanguageHelper
{
    /**
     * Sets the source language based on the language stored in the cookie.
     */

    public static function changeLanguage()
    {
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        $theme = Yii::$app->view->theme;

        if ($request->cookies->has('lang') ){
            $language = $request->cookies->getValue('lang');
            Yii::$app->language = $language;

        }else{
            $language = Yii::$app->language;
            $cookie = new Cookie([
                'name' => 'lang',
                'value' => $language
            ]);
            $response->cookies->add($cookie);
        }

        // Set the theme based on the language
        $themePath = Yii::getAlias('@app/themes/' . $language);
        if (is_dir($themePath)) {
            $theme->basePath = $themePath;
            $theme->baseUrl = '@web/themes/' . $language;
            $theme->pathMap = [
                '@app/views' => [
                    $themePath . '/views',
                ],
            ];
        }
    }
}
