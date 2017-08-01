<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yz\shoppingcart\ShoppingCart;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="main-banner banner text-center">
      <div class="container">  <br><br>  
            <h1>PT. Aristek Highpolymer </h1>
            <p>is a manufacturer and supplier of emulsion polymers, synthetic resins, as well as car care products.</p>
           <!-- <a href="post-ad.html">Post Free Ad</a>-->
      </div>
    </div>
<div class="wrap">
       
   <?php
    NavBar::begin([
        'brandLabel' => 'PT. ARISTEK HIGHPOLYMER',

        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],

    ]);
       $itemsInCart = Yii::$app->cart->getCount();
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
         ['label' => 'Catalog', 'url' => ['/catalog/list']],
        //['label' => 'Order', 'url' => ['/order/index'],],
[
            'label' => 'Order',
            'items' => [
                 ['label' => 'Order', 'url' => ['/order/index']],
                 '<li class="divider"></li>',
                 ['label' => 'Cetak Order', 'url' => ['/order/lihat']],
                                  '<li class="divider">Dropdown Header</li>',
                                   ['label' => 'Pembayaran ', 'url' => ['/pembayaran/create']],
                                  '<li class="divider">Dropdown Header</li>',

            ],
        ],
       // ['label' => 'Product', 'url' => ['/product/index']],
                ['label' => 'My cart' . ($itemsInCart ? " ($itemsInCart)" : ''), 'url' => ['/cart/list']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,

    ]);
    NavBar::end();
    ?>
    
    <br>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>    </div>

        <!-- content-starts-here -->
       
        <!--footer section start-->     
        <footer>
        <a href="#">
        <img width=200% src="<?php echo Yii::getAlias('/internlagi/advanced/backend/web/uploads/footer.JPG')?>" alt="" />
                         </a>


            
                
        </footer>
 
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
