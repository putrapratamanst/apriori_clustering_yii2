<?php 
use yii\helpers\Html;


?>  <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-left">Frekuensi Pembelian Saat Bersamaan</h2>
                        <br>


                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">  

                                <?php 
                                $i=1;
                                $count = count($data);
                                foreach ($data as $key => $value) {
                                                               ?>


                                   <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                           <a href="<?=Yii::$app->homeUrl?>?r=product%2Fdetail&id=<?= $value["code"]?>"> 
                                                  <img id="img_<?=$value["code"]?>" src="<?php echo Yii::getAlias('/internlagi/advanced/backend/web/uploads').'/'.$value["image"] ?>" alt="<?= $value["code"] ?>" />

                                            <h2 id= "txtPrice_<?=$value["code"]?>"> <?= $value["price"]?></h2>

                                                <p>
                                                <?php echo $value["name"] ?>
                                           <a href="<?=Yii::$app->homeUrl?>?r=product%2Fdetail&id=<?= $value["code"]?>"
                                                  id="txtPro_<?=$value["code"]?>">
                                                      
                                                  </a>

                                                </p>                                                   
                                                <div class="interested text-center">
            <i class="glyphicon glyphicon-shopping-cart"></i>
            <?= Html::a('Add to cart', ['cart/add', 'id' => $value['code']],
       ['class' => 'btn btn-success'])?>
          </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                  
                     <?php } ?>
                               
                                                          
                                </div>
                            </div>
                                 
                        </div>
                    </div><!--/recommended_items-->