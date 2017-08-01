<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Product;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductIn */
/* @var $form yii\widgets\ActiveForm */
$product = Product::find()->all();
?>
<div class="product-in-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_product')->dropDownList(ArrayHelper::map($product, 'code', 'code'), ['prompt' => 'Pilih Product']) ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
