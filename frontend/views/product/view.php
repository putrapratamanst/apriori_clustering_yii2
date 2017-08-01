<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
            <?= Html::a('Add Cart', ['/cart/add', 'id' => $model->code], ['class' => 'btn btn-success']) ?>
          </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'code',
            'name',
            'slug',
            'description:ntext',
            'category_id',
            'price',
            'suggested_use:ntext',
[
            'format'=>'raw',
            'attribute'=>'image',
            'value'=>Html::img($model->imageViewer,['class'=>'img-thumbnail','style'=>'width:200px;'])
        ]         ],
    ]) ?>

</div>
