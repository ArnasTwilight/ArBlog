<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AdminAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="grid">
<?php $this->beginBody() ?>

<aside class="aside-menu aside-menu--grid">
    <nav class="aside-nav">
        <h1 class="aside-nav__title">Admin<br>Panel</h1>
        <ul class="aside-nav__list">

            <li class="aside-nav__item">
                <div class="category-icon"></div><a href="/admin/category">Category</a>
            </li>
            <li class="aside-nav__item">
                <div class="article-icon"></div><a href="/admin/article">Article</a>
            </li>
            <li class="aside-nav__item">
                <div class="user-icon"></div><a href="/admin/user">User</a>
            </li>
            <li class="aside-nav__item">
                <div class="tag-icon"></div><a href="/admin/tag">Tag</a>
            </li>
            <li class="aside-nav__item">
                <div class="back-icon"></div><a href="/">Back to site</a>
            </li>

        </ul>
    </nav>
</aside>

<header class="header-menu header-menu--grid">
    <nav class="header-nav">
        <div class="header-nav__item logo"><a href="#"></a></div>
    <?php
    echo Nav::widget([
        'options' => ['class' => 'header-nav__list'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site']],
            ['label' => 'Category', 'url' => ['/site/category']],
            ['label' => 'About us', 'url' => ['/site/about']],
            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    ?>
    </nav>
    <div class="buttons-social">
        <a href="https://discord.gg/c88nuarQd7" class="buttons-social__item"><div class="discord"></div></a>
        <a href="https://github.com/ArnasTwilight/ArBlog" class="buttons-social__item"><div class="git-hub"></div></a>
    </div>
</header>

<main class="content content--grid">
    <?= $content ?>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

