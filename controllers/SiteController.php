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
    const INDEX_POST_NUMBER = 3;

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
        $recent = Article::getRecent(self::RECENT_ASIDE_POST_NUMBER);
        $popular = Article::getPopular(self::POPULAR_ASIDE_POST_NUMBER);
        $articles = Article::getAll(self::INDEX_POST_NUMBER);
        $asideCategories = Category::getAsideCategory(self::CATEGORIES_ASIDE_NUMBER);

        return $this->render('index', [
            'recent' => $recent,
            'popular' => $popular,
            'articles' => $articles,
            'asideCategories' => $asideCategories,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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

        return $this->render('single', [
            'article' => $article,
        ]);
    }

    public function actionCategory($id) {

        $category = Category::findOne($id);
        $article = Article::find()->where(['category_id' => $id])->orderBy('date asc')->limit(3)->all();

        return $this->render('category', [
            'category' => $category,
            'article' => $article,
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
