<?php

/** @var yii\web\View $this */
/** @var app\controllers\SiteController $asidePopular */
/** @var app\controllers\SiteController $asideRecent */
/** @var app\controllers\SiteController $asideCategories */
/** @var app\controllers\SiteController $asideDiscord */

use yii\helpers\Url;

$this->title = 'Tags';
?>

<?= $this->render('/partials/sidebar', [
    'popular' => $asidePopular,
    'recent' => $asideRecent,
    'categories' => $asideCategories,
    'discord' => $asideDiscord,
]); ?>

<main class="main grid--main">
    <article class="categories">
        <ul class="categories__list">

            <?php if(Yii::$app->session->getFlash('tags')): ?>
                <li class="flash--category-tags">
                    <?= Yii::$app->session->getFlash('tags') ?>
                </li>
            <?php endif; ?>

            <?php if(!empty ($tags)): foreach ($tags as $tag): ?>
                <li class="categories__item"><a href="<?= Url::toRoute(['site/tag', 'id' => $tag->id]) ?>"><?= $tag->title ?></a></li>
            <?php endforeach; endif; ?>

        </ul>
    </article>
</main>