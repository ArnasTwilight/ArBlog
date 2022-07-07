<?php
use yii\helpers\Url;

/** @var app\models\AsideMenu $popular */
/** @var app\models\AsideMenu $recent */
/** @var app\models\AsideMenu $categories */
/** @var app\models\AsideMenu $discord */

?>

<aside class="aside-menu grid--aside">

    <?php if (!empty($popular)): ?>
    <section class="popular">
        <h4 class="aside-menu__title">Popular</h4>
        <div class="line"></div>
        <?php foreach ($popular as $post): ?>
            <div class="aside-menu__img">
                <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]) ?>">
                    <img src="<?= $post->getImage($post->id) ?>" alt="popular post">
                    <h5 class="min-post-title"><?= $post->title ?></h5>
                </a>
            </div>
        <?php endforeach;?>
    </section>
    <?php endif; ?>

    <?php if (!empty($recent)): ?>
        <section class="recent">
            <div class="line"></div>
            <h4 class="aside-menu__title">Recent</h4>
            <div class="line"></div>
            <?php foreach ($recent as $post): ?>
                <div class="aside-menu__img">
                    <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]) ?>">
                        <img src="<?= $post->getImage($post->id) ?>" alt="recent post">
                        <h5 class="min-post-title"><?= $post->title ?></h5>
                    </a>
                </div>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

    <?php if (!empty($categories)): ?>
    <section class="category">
        <div class="line"></div>
        <h4 class="aside-menu__title">Category</h4>
        <div class="line"></div>
        <ul class="category-list">
            <?php foreach ($categories as $category):?>
                <li class="category-list__item"><a href="<?= Url::toRoute(['site/category', 'id' => $category->id]) ?>"><?= $category->title ?></a></li>
            <?php endforeach;?>
        </ul>
    </section>
    <?php endif; ?>

    <?php if ($discord === true): ?>
        <section class="discord-widget">
            <iframe src="https://discord.com/widget?id=249297598530191361&theme=light" width="245" height="400"
                    allowtransparency="true" frameborder="0"
                    sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
        </section>
    <?php endif; ?>

</aside>
