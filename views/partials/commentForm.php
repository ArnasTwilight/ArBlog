<?php
/** @var app\controllers\SiteController $article */
/** @var app\controllers\SiteController $comments */
/** @var app\controllers\SiteController $commentForm */

use yii\widgets\ActiveForm;

?>

<?php if (!Yii::$app->user->isGuest) :?>

    <?php if(Yii::$app->session->getFlash('comment')): ?>
        <div class="flash-comment">
            <?= Yii::$app->session->getFlash('comment') ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin([
        'action' => ['site/comment', 'id' => $article->id],
        'options' => ['class' => 'form-comment', 'role' => 'form'
        ]]) ?>
    <?= $form->field($commentForm, 'comment')->textarea(['class' => 'text-comment', 'placeholder' => 'Write Message'])->label(false) ?>
    <button type="submit" class="btn">Post Comment</button>
    <?php ActiveForm::end(); ?>

<?php endif; ?>
