<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Register';
?>

<div class="grid--main">

    <div class="login-container">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
//                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'label'],
                'inputOptions' => ['class' => 'input'],
                'errorOptions' => ['class' => 'error'],
            ],
        ]); ?>

        <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'passwordRepeat')->passwordInput() ?>

        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Register', ['class' => 'btn', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>


