<?php

/** @var yii\web\View $this */
/** @var app\controllers\SiteController $article */
/** @var app\controllers\SiteController $asidePopular */
/** @var app\controllers\SiteController $asideRecent */
/** @var app\controllers\SiteController $asideCategories */
/** @var app\controllers\SiteController $asideDiscord */
/** @var app\controllers\SiteController $tags */
/** @var app\controllers\SiteController $comments */
/** @var app\controllers\SiteController $commentForm */
/** @var app\controllers\SiteController $pagination */

use yii\helpers\Url;
use yii\widgets\LinkPager;


$this->title = $article->title;
?>

<?= $this->render('/partials/sidebar', [
    'popular' => $asidePopular,
    'recent' => $asideRecent,
    'categories' => $asideCategories,
    'discord' => $asideDiscord,
]); ?>

<main class="main grid--main">
    <article class="post">
        <div class="post__img">
            <img src="<?= $article->getImage($article->id) ?>" alt="post image">
            <a href=""><h2 class="post__title"><?= $article->title ?></h2></a>
        </div>
        <div class="post__short-info">
            <h3 class="post__category"><a
                        href="<?= Url::toRoute(['site/category', 'id' => $article->category->id]) ?>"><?= $article->category->title ?></a>
            </h3>

            <?php if (!empty($tags)): ?>
                <div class="post__tags">
                    <?php foreach ($tags as $tag): ?>
                        <a href="<?= Url::toRoute(['site/tag', 'id' => $tag->id]) ?>"
                           class="post__tags-item"><?= $tag->title ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="line"></div>
            <p class="post__description">
                <?= $article->content ?>
            </p>
            <div class="post__info">
                <div class="post__date"><?= $article->getDate() ?></div>
                <div class="post__viewed">
                    <p><?= (int)$article->viewed ?></p>
                    <div class="viewed-icon"></div>
                </div>
            </div>

            <div class="post__author">
                <?php if ($article->user != null): ?>
                    <img src="<?= $article->user->getImage() ?>" alt="author_avatar">
                    <p class="author-name"><?= $article->user->name ?></p>
                <?php endif; ?>
            </div>

        </div>
    </article>

    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
            <section class="comment">
                <div class="user__info">
                    <img class="comment__user-img" src="<?= $comment->user->getImage($comment->user->id) ?>"
                         alt="avatar">
                    <h4 class="comment__user-name"><?= $comment->user->name ?></h4>
                    <p class="comment__date"><?= $comment->getDate() ?></p>
                </div>
                <p class="comment__text"><?= $comment->text ?></p>
            </section>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php
    echo LinkPager::widget([
        'pagination' => $pagination,
    ])
    ?>

    <?= $this->render('/partials/commentForm', [
        'article' => $article,
        'comments' => $comments,
        'commentForm' => $commentForm,
    ]) ?>

</main>
