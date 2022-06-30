<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = 'Update: ' . $model->login;
?>
<main class="main grid--main cabinet">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</main>
