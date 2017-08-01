<?php

/* @var $this yii\web\View */

$this->title = 'PT. ARISTEK HIGHPOLYMER';
?>
<br>

<div class="container-fluid">             <?php foreach($categories as $category){ ?>

   <div class="col-sm-4">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                       <a href="<?=Yii::$app->homeUrl?>?r=category%2Fdetail&id=<?= $category["id"]?>"> 
                            <div class="focus-border">
                                <div class="focus-layout">
                                    <div class="focus-image">
  <img src="<?php echo Yii::getAlias('/internlagi/advanced/backend/web/uploads').'/'.$category->image; ?>" class=" img-responsive" >  

                                    </div>
                                    <h4 class="clrchg">                            
                                    <?php echo $category->title; ?>
</h4>
                                </div>
                            </div>
                        </a>
                    </div>               

                <div class="clearfix"></div>
                </div>
            </div>
                 <?php } ?>

        </div>   <br>
<hr>
