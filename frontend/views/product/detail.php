
<?php use yii\helpers\Html;

?>

					<?php foreach ($product as $key => $value) { ?>

	
	<!--single-page-->
	<div class="single-page main-grid-border">
		<div class="container">
			
			<div class="product-desc">
				<div class="col-md-7 product-view">
				
					<div class="flexslider">
						<ul class="slides">
						<img id="img_<?=$value["id"]?>" src="<?php echo Yii::getAlias('/internlagi/advanced/backend/web/uploads').'/'.$value["image"] ?>" alt="<?= $value["id"] ?>" />
						</ul>
					</div>
					<!-- FlexSlider -->
					  <script defer src="js/jquery.flexslider.js"></script>
					<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

					<!-- //FlexSlider -->
					<div class="product-details">
						<h4>Name of Product : <a href="#"><?php echo $value->name?></a></h4>
						<p><strong>Suggested Use </strong>: <?php echo $value->suggested_use; ?></p>
						<p><strong>Description</strong> : <?php echo $value->description; ?></p>
					
					</div>
				</div>
				<div class="col-md-5 product-details-grid">
					<div class="item-price">
						<div class="product-price">
							<p class="p-price">Price</p>
							<h3 class="rate"><?php echo $value->price; ?></h3>
							<div class="clearfix"></div>
						</div>
						<div class="condition">
							<p class="p-price">Code</p>
							<h4><?php echo $value->code; ?></h4>
							<div class="clearfix"></div>
						</div>
						<div class="itemtype">
							<p class="p-price">Category Type</p>
							<h5><?php echo $value->category->title; ?></h5>
							<div class="clearfix"></div>
						</div>
					</div>
										<?php } ?>

					<div class="interested text-center">
						<i class="glyphicon glyphicon-shopping-cart"></i>
						<?= Html::a('Add to cart', ['cart/add', 'id' => $value->id],
       ['class' => 'btn btn-success'])?>
					</div>
						
				</div>
			<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--//single-page-->
	<!--footer section start-->		
		
<?php

use frontend\widgets\aprioriWidget;


?>

 <?= aprioriWidget::widget(); ?>
