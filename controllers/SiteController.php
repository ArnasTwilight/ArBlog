<?php

namespace app\controllers;

use app\models\Article;
use app\models\AsideMenu;
use app\models\Category;
use app\models\CommentForm;
use app\models\Tag;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;

class SiteController extends Controller
{
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

        $aside = AsideMenu::getAside(true, false, true, true);

        return $this->render('index', [
            'articles' => $data['element'],
            'pagination' => $data['pagination'],
            'asidePopular' => $aside['popular'],
            'asideCategories' => $aside['categories'],
            'asideDiscord' => $aside['discord'],
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
//    public function actionAbout()
//    {
//        return $this->render('about');
//    }

    public function actionView($id)
    {
        if (empty(Article::findOne($id)))
        {
            return $this->redirect('error');
        }

        $article = Article::findOne($id);
        $tags = $article->getSelectedTags('all');

        $article->viewedCounter();
        $comments = $article->getArticleComments($id, 5);
        $commentForm = new CommentForm();

        $aside = AsideMenu::getAside(true, true, true, true);

        return $this->render('single', [
            'tags' => $tags,
            'article' => $article,
            'comments' => $comments['element'],
            'pagination' => $comments['pagination'],
            'commentForm' => $commentForm,
            'asidePopular' => $aside['popular'],
            'asideRecent' => $aside['recent'],
            'asideCategories' => $aside['categories'],
            'asideDiscord' => $aside['discord'],
        ]);
    }

    public function actionCategory($id)
    {
        if (empty(Category::findOne($id))) {
            return $this->redirect('error');
        }

        $category = Category::findOne($id);
        $data = Article::getAllPostCategory($category['id'], self::PAGE_SIZE);

        if (empty($data['element'])) {
            Yii::$app->getSession()->setFlash('category-no-post', 'No post in: ' . $category->title);
        }


        return $this->render('category', [
            'category' => $category,
            'articles' => $data['element'],
            'pagination' => $data['pagination'],
        ]);
    }

    public function actionCategories()
    {
        if (empty(Category::getAll())) {
            Yii::$app->getSession()->setFlash('categories', 'No categories!');
        }

        $categories = Category::getAll();
        $aside = AsideMenu::getAside(true, true, true, true);

        return $this->render('categories', [
            'categories' => $categories,
            'asidePopular' => $aside['popular'],
            'asideRecent' => $aside['recent'],
            'asideCategories' => $aside['categories'],
            'asideDiscord' => $aside['discord'],
        ]);
    }

    public function actionComment($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new CommentForm();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->saveComment($id)) {
                Yii::$app->getSession()->setFlash('comment', 'Your comment will be added soon!');
                return $this->redirect(['site/view', 'id' => $id]);
            }
        }
    }

    public function actionTags()
    {
        if (empty(Tag::getAll())) {
            Yii::$app->getSession()->setFlash('tags', 'No tags!');
        }

        $tags = Tag::getAll();
        $aside = AsideMenu::getAside(true, true, true, true);

        return $this->render('tags', [
            'tags' => $tags,
            'asidePopular' => $aside['popular'],
            'asideRecent' => $aside['recent'],
            'asideCategories' => $aside['categories'],
            'asideDiscord' => $aside['discord'],
        ]);
    }

    public function actionTag($id)
    {
        if (empty(Tag::findOne($id))){
            return $this->redirect('error');
        }

        $tag = Tag::findOne($id);
        $data = $tag->getSelectedTags();

        if (empty($data['element'])) {
            Yii::$app->getSession()->setFlash('tag-no-post', 'No post in: ' . $tag->title);
        }

        return $this->render('tag', [
            'tag' => $tag,
            'articles' => $data['element'],
            'pagination' => $data['pagination'],
        ]);
    }
}
