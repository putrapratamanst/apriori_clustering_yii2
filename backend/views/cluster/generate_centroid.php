    <div class="container margin-b70">
      <div class="row">
        <div class="col-md-12">
          <h1>Data Akhir</h1>

          <div id="body">
          <a  class="btn btn-primary" href="index.php?r=cluster%2Fgeneraterata">Proses Data Rata-Rata</a> <br><br>
            <a class="btn btn-warning" href="index.php?r=cluster%2Fgeneratecentroid">Proses Data Akhir</a>
                        <a class="btn btn-danger" href="index.php?r=cluster%2Fiterasikmeans">Proses Iterasi K-Means</a><br><br>

          <div class="table-responsive">
            <table  id="table_data" class="table table-bordered table-striped table-admin">
            <tr><td>Centroid 1</td><td>Fast Moving</td><td><?php echo $data['c1']; ?></td></tr>
            <tr><td>Centroid 2</td><td>Slow Moving</td><td><?php echo $data['c2']; ?></td></tr>
            <tr><td>Centroid 3</td><td>Dead Stock</td><td><?php echo $data['c3']; ?></td></tr>
         
          </table>
          </div>
          <br>
          <br>
          <div class="table-responsive">
            <table  id="table_data" class="table table-bordered table-striped table-admin">
            <tr align="center">

            <td>ID Product</td>
            <td>Product Name</td>
                        <td>Quantity Order</td>

            <td>Quantity</td>
            <td>Price</td>
           
            <td>Rata-Rata</td>

            <td colspan="3">Distance</td>
             <td>Predikat</td>
            </tr>
            <?php foreach($dataproducts as $s){ ?>
            <tr>
            <td><?php echo $s['id']; ?></td>
            <td><?php echo $s['name_product']; ?></td>
                        <td><?php echo $s['stock']; ?></td>

            <td><?php echo $s['quantity']; ?></td>
            <td><?php echo $s['price']; ?></td>

              
            <td><?php echo $s['rata_rata']; ?></td>
                       <td><?php echo $s['d1']; ?></td>
                       <td><?php echo $s['d2']; ?></td>
                       <td><?php echo $s['d3']; ?></td>
                       <td><?php echo $s['predikat']; ?></td>

                         </tr>
            <?php } ?>
          </table>
          </div>
          </div>

         <p class="footer">Page rendered in <strong><?php echo Yii::getLogger()->getElapsedTime(); ?></strong> seconds</p>
        </div>
      </div>
    </div>
