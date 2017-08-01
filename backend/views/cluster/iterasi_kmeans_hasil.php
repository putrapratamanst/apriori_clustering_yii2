    <div class="container margin-b70">
      <div class="row">
        <div class="col-md-12">
              <h1>Data Hasil Iterasi</h1>
            <div id="body">
            <a class="btn btn-primary" href="index.php?r=cluster%2Fiterasikmeans">Mulai Awal</a><br><br>
            <?php
              foreach($data['q'] as $hq)
              {
            ?>
            <center><h3>Iterasi ke-<?php echo $hq['iterasi']; ?></h3></center>
            <div class="table-responsive">
            <table  id="table_data" class="table table-bordered table-admin">
              <tr align="center"><td>C1</td><td>C2</td><td>C3</td></tr>
              <?php



$connection = new \yii\db\Connection([
        'dsn' => 'mysql:host=localhost;dbname=internlagi',
        'username' => 'root',
        'password' => '',
        ]);
      $connection->open();
$q2 = (new \yii\db\Query())
    ->select('*')
    ->from('centroid_temp')
    ->where(['iterasi' => $hq['iterasi']])
    ->all();
                foreach($q2 as $tq)
                {
                $warna1="";
                $warna2="";
                $warna3="";
                if($tq['c1']==1){$warna1='#FFFF00';} else{$warna1='#EAEAEA';}
                if($tq['c2']==1){$warna2='#FFFF00';} else{$warna2='#EAEAEA';}
                if($tq['c3']==1){$warna3='#FFFF00';} else{$warna3='#EAEAEA';}
              ?>
              <tr align="center"><td bgcolor="<?php echo $warna1; ?>"><?php echo $tq['c1']; ?></td>

              <td bgcolor="<?php echo $warna2; ?>"><?php echo $tq['c2']; ?></td>
              <td bgcolor="<?php echo $warna3; ?>"><?php echo $tq['c3']; ?></td></tr>
              <?php
                }
              ?>
            </table>
            </div>
            <?php
              }
            ?>
            </div>


            <table  id="table_data" class="table table-bordered table-admin">
              <tr align="center"><td>ID Product</td><td>Product Name</td><td>Predikat</td></tr>
              <?php
                foreach($datahasil as $h)
                {
              ?>
              <tr align="center">
              <td><?php echo $h['id']; ?></td>
                 <td><?php echo $h['name_product']; ?></td>

              <td><?php echo $h['predikat']; ?></td>

              </tr>
              <?php
                }
              ?>
            </table>
            </div>

         <p class="footer">Page rendered in <strong><?php echo Yii::getLogger()->getElapsedTime(); ?></strong> seconds</p>
        </div>
      </div>
    </div>
