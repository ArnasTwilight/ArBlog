<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\PublicAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

PublicAsset::register($this);
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
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<div class="wrapper grid">
    <header class="header grid--header">
        <nav class="header-nav">
            <ul class="header-nav__list">
                <li class="logo"><a href="/"></a></li>
                <li class="header-nav__item"><a href="<?= Url::toRoute('/')?>">Home</a></li>
                <li class="header-nav__item"><a href="<?= Url::toRoute('/site/categories')?>">Category</a></li>
                <li class="header-nav__item"><a href="#">About us</a></li>
            </ul>
        </nav>
        <div class="user">
            <ul class="user__list">
                <?php if (Yii::$app->user->isGuest):?>
                    <li class="user__item"><a href="<?= Url::toRoute('/auth/login')?>">Login</a></li>
                    <li class="user__item"><a href="<?= Url::toRoute('/auth/signup')?>">Register</a></li>
                <?php else: ?>
                    <li class="user__item"><a href="<?= Url::toRoute('/auth/logout')?>">logout</a></li>
                    <li class="user__item user-login"><a href="#"><?= Yii::$app->user->identity->login ?></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <?= $content ?>

    <footer class="footer grid--footer">

    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
