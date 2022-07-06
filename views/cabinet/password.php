<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = 'New password';
?>
<main class="main grid--main cabinet">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'oldPassword')->passwordInput()->label('Old password') ?>
    <?= $form->field($model, 'newPassword')->passwordInput() ?>
    <?= $form->field($model, 'repeatPassword')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</main>