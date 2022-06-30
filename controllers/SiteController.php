<?php

namespace app\controllers;

use app\models\Article;
use app\models\Category;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    const POPULAR_ASIDE_POST_NUMBER = 3;
    const RECENT_ASIDE_POST_NUMBER = 3;
    const CATEGORIES_ASIDE_NUMBER = 7;
    const PAGE_SIZE = 3;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = Article::getAll(self::PAGE_SIZE);

        $recent = Article::getRecent(self::RECENT_ASIDE_POST_NUMBER);
        $popular = Article::getPopular(self::POPULAR_ASIDE_POST_NUMBER);
        $asideCategories = Category::getAsideCategory(self::CATEGORIES_ASIDE_NUMBER);

        return $this->render('index', [
            'recent' => $recent,
            'popular' => $popular,
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'asideCategories' => $asideCategories,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionView($id)
    {
        $article = Article::findOne($id);

        $article["content"] = nl2br($article["content"]);

        return $this->render('single', [
            'article' => $article,
        ]);
    }

    public function actionCategory($id)
    {
        $category = Category::findOne($id);
        $data = Article::getAllPostCategory($category['id'], self::PAGE_SIZE);

        if (empty($data['articles'])){
            $emptyCategory = Article::nonePostInCategory($category['title']);
        }

        return $this->render('category', [
            'category' => $category,
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'emptyCategory' => $emptyCategory,
        ]);
    }

    public function actionCategories()
    {
        $categories = Category::getAll();

        return $this->render('categories', [
            'categories' => $categories,
        ]);
    }
}
