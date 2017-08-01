<?php
use yii\helpers\Html;
use yii\helpers\Markdown;
?>
<?php  ?>
<div class="col-xs-12 well">
    <div class="col-xs-2">

      <img src="<?php echo Yii::getAlias('/internlagi/advanced/backend/web/uploads').'/'. $model->image; ?>." width="100px" height="100px" /> </a> 

       
    </div>
    <div class="col-xs-6">
        <h2><?= Html::a($model->name,['product/detail', 'id' => $model->code]) ?></h2>
        <?= Markdown::process($model->description) ?>
    </div>

    <div class="col-xs-4 price">
        <div class="row">
            <div class="col-xs-12">Rp.<?= $model->price ?></div>
            <div class="col-xs-12"><?= Html::a('Add to cart', ['cart/add', 'id' => $model->code], ['class' => 'btn btn-success'])?></div>
        </div>
    </div>
</div>