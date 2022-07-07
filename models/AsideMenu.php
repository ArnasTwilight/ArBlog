<?php

namespace app\models;

use Yii;
use yii\base\Model;

class AsideMenu
{
    const POPULAR_ASIDE_POST_NUMBER = 3;
    const RECENT_ASIDE_POST_NUMBER = 3;
    const CATEGORIES_ASIDE_NUMBER = 7;

    public static function getAside($popular = false, $recent = false, $categories = false, $discord = false)
    {
        $data[] = '';

        if ($popular === true) {
            $data['popular'] = Article::getPopular(self::POPULAR_ASIDE_POST_NUMBER);
        }

        if ($recent === true) {
            $data['recent'] = Article::getRecent(self::RECENT_ASIDE_POST_NUMBER);
        }

        if ($categories === true) {
            $data['categories'] = Category::getAsideCategory(self::CATEGORIES_ASIDE_NUMBER);
        }

        if ($discord === true)
        {
            $data['discord'] = true;
        }

        return $data;
    }
}
