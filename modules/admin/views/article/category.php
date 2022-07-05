<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
/* @var app\modules\admin\controllers\ArticleController $selectedCategory */
/* @var app\modules\admin\controllers\ArticleController $categories */
?>

    <div class="article-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= Html::dropDownList('category', $selectedCategory, $categories, ['class' => 'form-control']) ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php
