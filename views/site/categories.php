<?php

/** @var yii\web\View $this */
/** @var app\controllers\SiteController $asidePopular */
/** @var app\controllers\SiteController $asideRecent */
/** @var app\controllers\SiteController $asideCategories */
/** @var app\controllers\SiteController $asideDiscord */
/** @var app\controllers\SiteController $categories */

use yii\helpers\Url;

$this->title = 'Categories';
?>

<?= $this->render('/partials/sidebar', [
    'popular' => $asidePopular,
    'recent' => $asideRecent,
    'discord' => $asideDiscord,
]); ?>

<main class="main grid--main">
    <article class="categories">
        <ul class="categories__list">

            <?php if(Yii::$app->session->getFlash('categories')): ?>
                <li class="flash--category-tags">
                    <?= Yii::$app->session->getFlash('categories') ?>
                </li>
            <?php endif; ?>

            <?php if(!empty ($categories)): foreach ($categories as $category): ?>
            <li class="categories__item"><a href="<?= Url::toRoute(['site/category', 'id' => $category->id]) ?>"><?= $category->title ?></a></li>
            <?php endforeach; endif; ?>
        </ul>
    </article>
</main>
