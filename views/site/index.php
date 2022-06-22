<?php

/** @var yii\web\View $this */
/** @var app\controllers\SiteController $popular */
/** @var app\controllers\SiteController $recent */
/** @var app\controllers\SiteController $categories */

use yii\helpers\Url;

$this->title = 'ArBlog';
?>

<aside class="aside-menu grid--aside">

    <section class="popular">
        <h4 class="aside-menu__title">Popular</h4>
        <div class="line"></div>
        <?php foreach ($popular as $post): ?>
            <div class="aside-menu__img">
                <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]) ?>">
                    <img src="public/source/img/Img_min_Post_3.png" alt="popular post">
                    <h5 class="min-post-title"><?= $post->title ?></h5>
                </a>
            </div>
        <?php endforeach;?>
    </section>
    <section class="category">
        <div class="line"></div>
        <h4 class="aside-menu__title">Category</h4>
        <div class="line"></div>
        <ul class="category-list">
            <?php foreach ($categories as $category):?>
                <li class="category-list__item"><a href="<?= Url::toRoute(['site/category', 'id' => $category->id]) ?>"><?= $category->title ?></a></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section class="discord-widget">
        <iframe src="https://discord.com/widget?id=249297598530191361&theme=light" width="245" height="400" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
    </section>

</aside>

<main class="main grid--main">
    <?php foreach ($recent as $post):?>
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
