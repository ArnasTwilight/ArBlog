<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Set Image', ['set-image', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Set Category', ['set-category', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Set Tags', ['set-tags', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
        <?php if (!empty($model->image)):?>
        <?= Html::a('Delete Image', ['delete-image', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?php endif; ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'description:ntext',
            'date',
            'image',
            'viewed',
            'status',
            'user_id',
            'category_id',
        ],
    ]) ?>

</div>
