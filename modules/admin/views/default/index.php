<?php

/** @var yii\web\View $this */
/** @var app\modules\admin\controllers\DefaultController $users */
/** @var app\modules\admin\controllers\DefaultController $recent */
/** @var app\modules\admin\controllers\DefaultController $tags */

/** @var app\modules\admin\controllers\DefaultController $categories */

use yii\helpers\Url;

$this->title = 'Admin Panel';
?>
<div class="home-admin">
    <div class="container-info">
        <div class="header-info"><p>New users</p></div>
        <ul class="content-info">
            <?php foreach ($users as $user): ?>
                <li>
                    <span>ID: <?= $user->id ?></span>
                    <a href="<?= Url::toRoute(['user/view', 'id' => $user->id]) ?>"><?= $user->login ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="container-info">
        <div class="header-info"><p>Recent posts</p></div>
        <ul class="content-info">
            <?php foreach ($recent as $post): ?>
                <li>
                    <span>ID: <?= $post->id ?></span>
                    <a href="<?= Url::toRoute(['article/view', 'id' => $post->id]) ?>"><?= $post->title ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="container-info">
        <div class="header-info"><p>New tags</p></div>
        <ul class="content-info">
            <?php foreach ($tags as $tag): ?>
                <li>
                    <span>ID: <?= $tag->id ?></span>
                    <a href="<?= Url::toRoute(['tag/view', 'id' => $tag->id]) ?>"><?= $tag->title ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="container-info">
        <div class="header-info"><p>New categories</p></div>
        <ul class="content-info">
            <?php foreach ($categories as $category): ?>
                <li>
                    <span>ID: <?= $category->id ?></span>
                    <a href="<?= Url::toRoute(['category/view', 'id' => $category->id]) ?>"><?= $category->title ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>