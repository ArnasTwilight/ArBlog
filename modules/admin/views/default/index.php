<?php

/** @var yii\web\View $this */
/** @var app\modules\admin\controllers\DefaultController $users */
/** @var app\modules\admin\controllers\DefaultController $recent */
/** @var app\modules\admin\controllers\DefaultController $tags */
/** @var app\modules\admin\controllers\DefaultController $categories */

$this->title = 'Admin Panel';
?>

<div class="admin-default-index">
    <h2>User</h2>
    <div>
        <?php foreach ($users as $user):?>
            <p>ID:<?= $user->id ?> Login: <?= $user->login; ?></p>
        <?php endforeach; ?>
    </div>
    <h2>Recent post</h2>
    <div>
        <?php foreach ($recent as $post):?>
            <p><?= $post->id ?> <?= $post->title ?></p>
        <?php endforeach; ?>
    </div>
    <h2>Tags</h2>
    <div>
        <?php foreach ($tags as $tag):?>
            <p><?= $tag->id ?> <?= $tag->title ?></p>
        <?php endforeach; ?>
    </div>
    <h2>Categories</h2>
    <div>
        <?php foreach ($categories as $category):?>
            <p><?= $category->id ?> <?= $category->title ?></p>
        <?php endforeach; ?>
    </div>
</div>
