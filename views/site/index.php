<?php

/** @var yii\web\View $this */
/** @var app\controllers\SiteController $popular */
/** @var app\controllers\SiteController $recent */
/** @var app\controllers\SiteController $categories */
/** @var app\controllers\SiteController $articles */

use yii\helpers\Url;

$this->title = 'ArBlog';
?>

<?= $this->render('/partials/sidebar', [
    'popular' => $popular,
    'recent' => $recent,
    'asideCategories' => $asideCategories,
]); ?>

<main class="main grid--main">
    <?php foreach ($articles as $post):?>
        <article class="post">
            <div class="post__img">
                <img src="<?= $post->getImage($post->id) ?>" alt="post image">
                <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]) ?>"><h2 class="post__title"><?= $post->title ?></h2></a>
            </div>
            <div class="post__short-info">
                <h3 class="post__category"><a href="#"><?= $post->category->title ?></a></h3>
                <div class="line"></div>
                <p class="post__description">
                    <?= $post->description ?>
                </p>
            </div>
        </article>
    <?php endforeach; ?>
</main>
