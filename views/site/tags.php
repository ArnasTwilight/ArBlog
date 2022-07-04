<?php

/** @var yii\web\View $this */
/** @var app\controllers\SiteController $categories */
/** @var app\controllers\SiteController $article */

use yii\helpers\Url;

$this->title = 'Tags';
?>

<?= $this->render('/partials/sidebar', [
    'popular' => $popular,
    'recent' => $recent,
    'asideCategories' => $asideCategories,
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