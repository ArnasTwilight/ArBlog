<?php

/** @var yii\web\View $this */
/** @var app\controllers\SiteController $article */
/** @var app\controllers\SiteController $tags */
/** @var app\controllers\SiteController $comments */
/** @var app\controllers\SiteController $commentForm */

/** @var app\controllers\SiteController $pagination */

use yii\helpers\Url;
use yii\widgets\LinkPager;


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
