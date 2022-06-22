<?php

/** @var yii\web\View $this */
/** @var app\controllers\SiteController $article */

use yii\helpers\Url;

$this->title = $article->title;
?>
<main class="main grid--main">
        <article class="post">
            <div class="post__img">
                <img src="<?= Url::toRoute(['public/source/img/Image_Post_3.png']) ?>" alt="post image">
                <a href=""><h2 class="post__title"><?= $article->title ?></h2></a>
            </div>
            <div class="post__short-info">
                <h3 class="post__category"><a href="#"><?= $article->category_id ?></a></h3>
                <div class="line"></div>
                <p class="post__description">
                    <?= $article->content ?>
                </p>
            </div>
        </article>
</main>
