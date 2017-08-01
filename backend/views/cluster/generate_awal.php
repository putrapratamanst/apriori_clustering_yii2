


    <div class="container margin-b70">
      <div class="row">
        <div class="col-md-12">
          <h1>Data Awal</h1>

            <div id="body">
            <a class="btn btn-primary" href="index.php?r=cluster%2Fgeneraterata">Proses Data Rata-Rata</a><br><br>
            <div class="table-responsive">
            <table  id="table_data" class="table table-bordered table-striped table-admin">
              <tr><td>Product ID</td>
              <td>Product Name</td>
              <td>Product Stock</td>
              <td>Product Price</td>
              <td>Quantity Order</td>
              </tr>
              <?php foreach($dataproducts as $s){ ?>
              <tr><td><?php echo $s['id']; ?></td><td><?php echo $s['name_product']; ?></td><td><?php echo $s['stock']; ?></td>
              <td><?php echo $s['price']; ?></td>
                            <td><?php echo $s['quantity']; ?></td>

              </tr>
              <?php } ?>
            </table>
            </div>
            </div>

          <p class="footer">Page rendered in <strong><?php echo Yii::getLogger()->getElapsedTime(); ?></strong> seconds</p>
        </div>
      </div>
    </div>

<?php

use backend\widgets\chartWidget;


?>

 <?= chartWidget::widget(); ?>
