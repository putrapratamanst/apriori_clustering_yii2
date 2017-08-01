<?php use yii\helpers\Html;
?>

<div class="features_items"><!--features_items-->
                       <?php foreach ($model as $value => $key) { ?>

                       <h2 class="title text-center"><?php echo $key->title; ?></h2> 
                       <?php } ?><hr>
                       <?php foreach ($product as $key => $value) {
                     
                       ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
    <a href="<?=Yii::$app->homeUrl?>?r=product%2Fdetail&id=<?= $value["code"]?>"> 
  <img id="img_<?=$value["id"]?>" src="<?php echo Yii::getAlias('/internlagi/advanced/backend/web/uploads').'/'.$value["image"] ?>" alt="<?= $value["code"] ?>" /></a>


 <p><a href="<?=Yii::$app->homeUrl?>?r=product%2Fdetail&id=<?= $value["code"]?>" id="txtPro_<?=$value["code"]?>"> <?= $value["name"]?></a></p>

      <div class="col-xs-12"><?= Html::a('Add to cart', ['cart/add', 'id' => $value['code']],
       ['class' => 'btn btn-success'])?>
       </div>
  </div>
                                      
                                </div> 
                                
                            </div>

                        </div>
<?php } ?>
                        </div>

