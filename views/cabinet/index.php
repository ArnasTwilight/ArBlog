<?php

/** @var yii\web\View $this */
/** @var app\controllers\CabinetController $user */

/** @var app\controllers\CabinetController $model */

use yii\helpers\Html;

$this->title = 'Cabinet: ' . $user->login;
?>
<main class="main grid--main cabinet">

    <section class="cabinet-user">
        <div>
            <img src="<?= $user->getImage($user->id) ?>" alt="avatar">
        </div>
        <ul class="user-info">
            <li class="user-info__item">Name: <?= $user->name ?></li>
            <li class="user-info__item">Login: <?= $user->login ?></li>
            <li class="user-info__item">E-mail: <?= $user->email ?></li>
            <li class="user-info__item">About: <?= $user->about ?></li>
            <li><?= Html::a('Set avatar', ['set-image', 'id' => $model->id], ['class' => 'btn user-btn']) ?></li>
            <li><?= Html::a('Update profile', ['update', 'id' => $model->id], ['class' => 'btn user-btn']) ?></li>
            <?php if (!empty($user->image)):?>
                <li><?= Html::a('Delete avatar', ['delete-image', 'id' => $model->id], ['class' => 'btn user-btn warning']) ?></li>
            <?php endif; ?>
        </ul>
    </section>

    <div class="control-user">
        <div class="black-theme">
            Dark theme:  <input type="checkbox" class="checkbox-theme">
        </div>

        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn user-btn danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

</main>
