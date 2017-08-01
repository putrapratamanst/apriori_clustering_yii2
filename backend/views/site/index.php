<?php

use yii\helpers\Html;
use common\models\ValueHelpers;
/* @var $this yii\web\View */

$this->title = '.:PT. ARISTEK HIGHPOLYMER:.';
$is_admin = ValueHelpers::getRoleValue('admin');

$is_produksi = ValueHelpers::getRoleValue('produksi');
$is_sales = ValueHelpers::getStatusValue('sales');
$is_kurir = ValueHelpers::getStatusValue('kurir');

//$is_baak = ValueHelpers::getRoleValue('BAAK');

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Selamat Datang di Admin!</h1>

        <p class="lead">Halaman ini dapat memberikan kemudahan bagi Admin untuk mengelola Web!.</p>

        </div>

    <div class="body-content">

            <div class="col-lg-4">
                <h2>User</h2>

                <p>
                     Disini Admin dapat melakukan manajemen bagi user.
                  </p>
                  <p>
                    <?php
if (!Yii::$app->user->isGuest
&& Yii::$app->user->identity->role_id =20) {
echo Html::a('Manage Users', ['user/index'],
['class' => 'btn btn-default']);
}
?>
</p>

          </div>
            <div class="col-lg-4">
                <h2>Barang</h2>

                <p>
                  Disini  Bagian Produksi dapat melakukan manajemen Barang.
                </p>
                <p>

                <?php
if (!Yii::$app->user->isGuest
&& Yii::$app->user->identity->role_id >=$is_produksi) {
echo Html::a('Kelola Barang', ['product/index'],
['class' => 'btn btn-default']);
}
?>
</p>

            </div>
            <div class="col-lg-4">
                <h2>Stock</h2>

                <p>Disini Bagian Produksi dapat melakukan manajemen Stock.</p>
<p>

                <?php
                if (!Yii::$app->user->isGuest
                && Yii::$app->user->identity->role_id >=$is_produksi) {
                echo Html::a('Kelola Stock', ['stock/index'],
                ['class' => 'btn btn-default']);
                }
                ?>
                </p>
                <div class="body-content">


        </div>
            </div>
        </div>




        <div class="col-lg-4">
            <h2>Barang Masuk</h2>

            <p>
              Disini Bagian Produksi dapat melakukan manajemen barang masuk.
            </p>
            <p>

            <?php
        if (!Yii::$app->user->isGuest
        && Yii::$app->user->identity->role_id >=$is_produksi) {
        echo Html::a('Kelola Barang Masuk', ['product-in/index'],
        ['class' => 'btn btn-default']);
        }
        ?>
        </p>

        </div>

        <div class="col-lg-4">
            <h2>Order</h2>

            <p>
              Disini Sales dapat melakukan manajemen order.
            </p>
            <p>

            <?php
        if (!Yii::$app->user->isGuest
        && Yii::$app->user->identity->role_id =40) {
        echo Html::a('Kelola Order', ['order/index'],
        ['class' => 'btn btn-default']);
        }
        ?>
        </p>

        </div>


        <div class="col-lg-4">
            <h2>Kirim Barang</h2>

            <p>
              Disini Kurir dapat melakukan manajemen barang terkirim.
            </p>
            <p>

            <?php
        if (!Yii::$app->user->isGuest
        && Yii::$app->user->identity->role_id >=30) {
        echo Html::a('Kelola Kirim Barang', ['order/kirim'],
        ['class' => 'btn btn-default']);
        }
        ?>
        </p>

        </div>


        <div class="col-lg-4">
            <h2>Category</h2>

            <p>
              Disini Admin dapat melakukan manajemen kategori.
            </p>
            <p>

            <?php
        if (!Yii::$app->user->isGuest
        && Yii::$app->user->identity->role_id>=$is_admin) {
        echo Html::a('Kelola kategori', ['category/index'],
        ['class' => 'btn btn-default']);
        }
        ?>
        </p>

        </div>

<?php $is_admin = 'admin' ?>
        <div class="col-lg-4">
            <h2>Clustering K-Means</h2>

            <p>
              Disini Admin dapat melakukan clustering K-Means.
            </p>
            <p>

            <?php
        if (!Yii::$app->user->isGuest
        && Yii::$app->user->identity->username >= $is_admin) {
        echo Html::a('Kelola Clustering K-Means', ['cluster/generateawal'],
        ['class' => 'btn btn-default']);
        }
        ?>
        </p>

        </div>
      


 <div class="col-lg-4">
            <h2>Pembayaran</h2>

            <p>
              Disini Sales dapat melihat pembayaran.
            </p>
            <p>

            <?php
        if (!Yii::$app->user->isGuest
        && Yii::$app->user->identity->username >= $is_admin) {
        echo Html::a('Kelola Pembayaran', ['pembayaran/index'],
        ['class' => 'btn btn-default']);
        }
        ?>
        </p>

        </div>
      
           
                   
                
                  </div>
