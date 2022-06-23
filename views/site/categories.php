<?php

/** @var yii\web\View $this */
/** @var app\controllers\SiteController $categories */
/** @var app\controllers\SiteController $article */

use yii\helpers\Url;

$this->title = 'Categories';
?>

<?= $this->render('/partials/sidebar', [
    'popular' => $popular,
    'recent' => $recent,
    'asideCategories' => $asideCategories,
]); ?>

<main class="main grid--main">
    <article class="categories">
        <ul class="categories__list">
            <?php if(!empty ($categories)): foreach ($categories as $category): ?>
            <li class="categories__item"><a href="<?= Url::toRoute(['site/category', 'id' => $category->id]) ?>"><?= $category->title ?></a></li>
            <?php endforeach; endif; ?>
        </ul>
    </article>
</main>
