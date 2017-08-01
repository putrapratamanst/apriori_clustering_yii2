<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use frontend\models\orderItems;
?>

<table>
    <tr>
        <td>
            <?=Html::img(Yii::getAlias('@backend').'/web/uploads/logo aristek.png', ['width' => 120])?>
        </td>
        <td>
            <h1>PT. Aristek Highpolymer</h1>
        </td>
    </tr>
</table>
<div class="semester-pendek-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'phone',
            'address:ntext',
            'email:email',
            'notes:ntext',
            'status',
            'user_id',
        ],
    ]) ?>

</div>
 <?= GridView::widget([
               'dataProvider'=>new yii\data\ActiveDataProvider([

                  'pagination'=>false,
                   'query'=>$model->getOrderItems(),

               ]),
               'columns'=>[
                 ['class' => 'kartik\grid\SerialColumn'],

                   'name_product',
                   'quantity',
                  //s 'price',
 [
          'label' => 'Price',
          //'attribute' => 'idDhs.idMatakuliah.jam',
          'pageSummary' => true,
        //  'pageSummary' => 'Total',
            'value' => function ($model) {
          if($model)
              return $model->price;
              return 0;
          }
      ],
                                    

                //      ['class' => 'kartik\grid\ActionColumn'],

                //   'product',
                  // 'qty'
               ],
               'showPageSummary' => true,

           ]) ?>

</div>
