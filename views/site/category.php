<?php

/** @var yii\web\View $this */
/** @var app\controllers\SiteController $category */
/** @var app\controllers\SiteController $articles */
/** @var app\controllers\SiteController $emptyCategory */

use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = $category->title;
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
                <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]) ?>" class="read_button">Read this post</a>
                <div class="post__info">
                    <div class="post__date"><?= $post->getDate() ?></div>
                    <div class="post__viewed">
                        <p><?= (int) $post->viewed ?></p>
                        <div class="viewed-icon"></div>
                    </div>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
    <?= $emptyCategory ?>
    <?php
    echo LinkPager::widget([
        'pagination' => $pagination,
    ])
    ?>
</main>
