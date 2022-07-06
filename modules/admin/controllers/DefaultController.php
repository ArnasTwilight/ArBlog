<?php

namespace app\modules\admin\controllers;

use app\models\Article;
use app\models\Category;
use app\models\Tag;
use app\models\User;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $users = User::find()->orderBy('id desc')->limit(5)->all();
        $recent = Article::find()->orderBy('id desc')->limit(3)->all();
        $categories = Category::find()->orderBy('id desc')->limit(3)->all();
        $tags = Tag::find()->orderBy('id desc')->limit(3)->all();

        return $this->render('index', [
            'users' => $users,
            'recent' => $recent,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public static function getAdmin()
    {
        $admin = User::findOne(Yii::$app->user->identity->id);
        unset($admin['password']);

        return $admin;
    }
}
