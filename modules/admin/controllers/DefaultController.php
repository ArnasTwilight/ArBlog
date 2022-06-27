<?php

namespace app\modules\admin\controllers;

use app\models\Article;
use app\models\Category;
use app\models\Tag;
use app\models\User;
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
        $users = User::find()->orderBy('id asc')->limit(5)->all();
        $recent = Article::find()->orderBy('id asc')->limit(3)->all();
        $categories = Category::find()->orderBy('id asc')->limit(3)->all();
        $tags = Tag::find()->orderBy('id asc')->limit(3)->all();

        return $this->render('index', [
            'users' => $users,
            'recent' => $recent,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
}
