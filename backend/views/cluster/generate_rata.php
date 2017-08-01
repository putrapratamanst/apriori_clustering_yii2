<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
?>

    <div class="container margin-b70">
      <div class="row">
        <div class="col-md-12">
          <h1>Data Rata-Rata</h1>

          <div id="body">
            <a class="btn btn-primary" href="index.php?r=cluster%2Fgeneratecentroid">Proses Data Akhir</a>
            <br><br>

            <div class="table-responsive">
              <table  id="table_data" class="table table-bordered table-striped table-admin">           

                <tr>
                  <td>Product ID</td>
                  <td>Product Name</td>
                   <td>Product Stock</td>
                  <td>Product Price</td>

                  <td>Quantity Order</td>

                  <td>Rata-Rata</td>
                </tr>


                <?php foreach($dataproducts as $s):  ?>


                <tr>


                  <td><?= $s['id']; ?></td>


                  <td><?= $s['name_product']; ?></td>

                                    <td><?= $s['stock']; ?></td>

                  <td><?= $s['price'] ?>         
                  </td>


                  <td><?= $s['quantity']; ?>      

                          </td>

       <td><?= $s['rata_rata']; ?>      

                          </td>


           
              

               </tr>        <?php endforeach; ?>                                                       


             </table>

           </div>
         </div>

         <p class="footer">Page rendered in <strong><?php echo Yii::getLogger()->getElapsedTime(); ?></strong> seconds</p>
       </div>
     </div>
   </div>
