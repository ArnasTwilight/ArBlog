<?php

/** @var yii\web\View $this */
/** @var app\controllers\SiteController $asidePopular */
/** @var app\controllers\SiteController $asideCategories */
/** @var app\controllers\SiteController $articles */
/** @var app\controllers\SiteController $pagination */
/** @var app\controllers\SiteController $asideDiscord */

use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'ArBlog';
?>

<?= $this->render('/partials/sidebar', [
    'popular' => $asidePopular,
    'categories' => $asideCategories,
    'discord' => $asideDiscord,
]); ?>

<main class="main grid--main">
    <?php foreach ($articles as $post):?>
        <article class="post">
            <div class="post__img">
                <img src="<?= $post->getImage($post->id) ?>" alt="post image">
                <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]) ?>"><h2 class="post__title"><?= $post->title ?></h2></a>
            </div>
            <div class="post__short-info">
                <h3 class="post__category"><a href="<?= Url::toRoute(['site/category', 'id' => $post->category->id]) ?>"><?= $post->category->title ?></a></h3>
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

                <div class="post__author">
                    <?php if ($post->user != null): ?>
                        <img src="<?= $post->user->getImage() ?>" alt="author_avatar">
                        <p class="author-name"><?= $post->user->name ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
    <?php
    echo LinkPager::widget([
        'pagination' => $pagination,
    ])
    ?>
</main>

