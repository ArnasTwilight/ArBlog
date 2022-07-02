<?php

/** @var yii\web\View $this */
/** @var app\controllers\SiteController $article */

use yii\helpers\Url;

$this->title = $article->title;
?>

<?= $this->render('/partials/sidebar', [
    'popular' => $popular,
    'recent' => $recent,
    'asideCategories' => $asideCategories,
]); ?>

<main class="main grid--main">
        <article class="post">
            <div class="post__img">
                <img src="<?= $article->getImage($article->id) ?>" alt="post image">
                <a href=""><h2 class="post__title"><?= $article->title ?></h2></a>
            </div>
            <div class="post__short-info">
                <h3 class="post__category"><a href="#"><?= $article->category->title ?></a></h3>
                <div class="line"></div>
                <p class="post__description">
                    <?= $article->content ?>
                </p>
                <div class="post__info">
                    <div class="post__date"><?= $article->getDate() ?></div>
                    <div class="post__viewed">
                        <p><?= (int) $article->viewed ?></p>
                        <div class="viewed-icon"></div>
                    </div>
                </div>
            </div>
        </article>
</main>
