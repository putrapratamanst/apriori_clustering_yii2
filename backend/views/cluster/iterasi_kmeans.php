    <div class="container margin-b70">
      <div class="row">
        <div class="col-md-12">
        <?php error_reporting(0); ?>
          <h1>PROSES ITERASI</h1>

            <div id="body">
            <a class="btn btn-primary" href="index.php?r=cluster%2Fiterasikmeanslanjut">Proses Iterasi Selanjutnya</a><br><br>
            <div class="table-responsive">
            <table  id="table_data" class="table table-bordered table-admin">
              <tr align="center">
              <td rowspan="2">ID Product</td>
              <td rowspan="2">Product Name</td>
              <td rowspan="2">Price</td>
              <td rowspan="2">Quantity</td>
              <td rowspan="2">Stock</td>

              <td rowspan="2">Rata Rata</td>
              <td colspan="3">Centroid 1</td><td colspan="3">Centroid 2</td><td colspan="3">Centroid 3</td><td rowspan="2">C1</td><td rowspan="2">C2</td><td rowspan="2">C3</td>
              </tr>
              <tr align="center">
       <td>8000</td><td>1000</td><td>2000</td>
              <td>2000</td><td>8000</td><td>1000</td>
              <td>1000</td><td>2000</td><td>8000</td>
              </tr>
              <?php 
                    $c1a = 8000;
              $c1b = 1000;
              $c1c = 2000;
              
              $c2a = 2000;
              $c2b = 8000;
              $c2c = 1000;
              
              $c3a = 1000;
              $c3b = 2000;
              $c3c = 8000;
              $c1a_b = "";
              $c1b_b = "";
              $c1c_b = "";
              
              $c2a_b = "";
              $c2b_b = "";
              $c2c_b = "";
              
              $c3a_b = "";
              $c3b_b = "";
              $c3c_b = "";
              
              $hc1=0;
              $hc2=0;
              $hc3=0;
              
              $no=0;
              $arr_c1 = array();
              $arr_c2 = array();
              $arr_c3 = array();
              
              $arr_c1_temp = array();
              $arr_c2_temp = array();
              $arr_c3_temp = array();

              $connection = new \yii\db\Connection([
        'dsn' => 'mysql:host=localhost;dbname=internlagi',
        'username' => 'root',
        'password' => '',
        ]);
      $connection->open();
        $user = $connection->createCommand()->truncateTable('centroid_temp')->execute();
        $user = $connection->createCommand()->truncateTable('hasil_centroid')->execute();
              foreach($dataproducts as $s){ ?>
              <tr><td><?php echo $s['id']; ?></td>
              <td><?php echo $s['name_product']; ?></td>
              <td><?php echo $s['price']; ?></td>
              <td><?php echo $s['quantity']; ?></td>
              <td><?php echo $s['stock']; ?></td>

              <td><?php echo $s['rata_rata']; ?></td>
              
              <td colspan="3"><?php 
                $hc1 = sqrt(pow(($s['price']-$c1a),2)+pow(($s['quantity']-$c1b),2)+pow(($s['stock']-$c1c),2));
                echo $hc1;
              ?></td>
              <td colspan="3"><?php 
                $hc2 = sqrt(pow(($s['price']-$c2a),2)+pow(($s['quantity']-$c2b),2)+pow(($s['stock']-$c2c),2));
                echo $hc2;
              ?></td>
              <td colspan="3"><?php 
                $hc3 = sqrt(pow(($s['price']-$c3a),2)+pow(($s['quantity']-$c3b),2)+pow(($s['stock']-$c3c),2));
                echo $hc3;
              ?></td>
              <?php 
              
              if($hc1<=$hc2)
              {
                if($hc1<=$hc3)
                {
                  $arr_c1[$no] = 1;
                }
                else
                {
                  $arr_c1[$no] = '0';
                }
              }
              else
              {
                $arr_c1[$no] = '0';
              }
              
              if($hc2<=$hc1)
              {
                if($hc2<=$hc3)
                {
                  $arr_c2[$no] = 1;
                }
                else
                {
                  $arr_c2[$no] = '0';
                }
              }
              else
              {
                $arr_c2[$no] = '0';
              }
              
              if($hc3<=$hc1)
              {
                if($hc3<=$hc2)
                {
                  $arr_c3[$no] = 1;
                }
                else
                {
                  $arr_c3[$no] = '0';
                }
              }
              else
              {
                $arr_c3[$no] = '0';
              }
              
              $arr_c1_temp[$no] = $s['price'];
              $arr_c2_temp[$no] = $s['quantity'];
              $arr_c3_temp[$no] = $s['stock'];
              
              $warna1="";
              $warna2="";
              $warna3="";
              ?>
              <?php if($arr_c1[$no]==1){$warna1='#FFFF00';} else{$warna1='#ccc';} ?><td bgcolor="<?php echo $warna1; ?>"><?php echo $arr_c1[$no] ;?></td>
              <?php if($arr_c2[$no]==1){$warna2='#FFFF00';} else{$warna2='#ccc';} ?><td bgcolor="<?php echo $warna2; ?>"><?php echo $arr_c2[$no] ;?></td>
              <?php if($arr_c3[$no]==1){$warna3='#FFFF00';} else{$warna3='#ccc';} ?><td bgcolor="<?php echo $warna3; ?>"><?php echo $arr_c3[$no] ;?></td>
              </tr>
              <?php
                  $connection = new \yii\db\Connection([
        'dsn' => 'mysql:host=localhost;dbname=internlagi',
        'username' => 'root',
        'password' => '',
        ]);
      $connection->open();
      $q = $connection->createCommand()
      ->insert('centroid_temp',[
        'iterasi'=>1,
      
        'c1'=>$arr_c1[$no],
        'c2'=>$arr_c2[$no],
        'c3'=>$arr_c3[$no],
        ])
      ->execute();

        
              $no++; } 
              
              //centroid baru 1.a
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c1);$i++)
              {
                $arr[$i] = $arr_c1_temp[$i]*$arr_c1[$i];
                if($arr_c1[$i]==1)
                {
                  $jum++;
                }
              }
              $c1a_b = array_sum($arr)/$jum;
              
              //centroid baru 1.b
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c2);$i++)
              {
                $arr[$i] = $arr_c2_temp[$i]*$arr_c1[$i];
                if($arr_c1[$i]==1)
                {
                  $jum++;
                }
              }
              $c1b_b = array_sum($arr)/$jum;

              
              
              //centroid baru 1.c
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c3);$i++)
              {
                $arr[$i] = $arr_c3_temp[$i]*$arr_c1[$i];
                if($arr_c1[$i]==1)
                {
                  $jum++;
                }
              }
              $c1c_b = array_sum($arr)/$jum;
              
              
              
              
              //centroid baru 2.a
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c1);$i++)
              {
                $arr[$i] = $arr_c1_temp[$i]*$arr_c2[$i];
                if($arr_c2[$i]==1)
                {
                  $jum++;
                }
              }
              $c2a_b = array_sum($arr)/$jum;


              
              
              //centroid baru 2.b
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c2);$i++)
              {
                $arr[$i] = $arr_c2_temp[$i]*$arr_c2[$i];
                if($arr_c2[$i]==1)
                {
                  $jum++;
                }
              }
              $c2b_b = array_sum($arr)/$jum;
              
              //centroid baru 2.c
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c3);$i++)
              {
                $arr[$i] = $arr_c3_temp[$i]*$arr_c2[$i];
                if($arr_c2[$i]==1)
                {
                  $jum++;
                }
              }
              $c2c_b = array_sum($arr)/$jum;
              
              
              
              
              //centroid baru 3.a
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c1);$i++)
              {
                $arr[$i] = $arr_c1_temp[$i]*$arr_c3[$i];
                if($arr_c3[$i]==1)
                {
                  $jum++;
                }
              }
              $c3a_b = array_sum($arr)/$jum;
              
              //centroid baru 3.b
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c2);$i++)
              {
                $arr[$i] = $arr_c2_temp[$i]*$arr_c3[$i];
                if($arr_c3[$i]==1)
                {
                  $jum++;
                }
              }
              $c3b_b = array_sum($arr)/$jum;
              
              //centroid baru 3.c
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c3);$i++)
              {
                $arr[$i] = $arr_c3_temp[$i]*$arr_c3[$i];
                if($arr_c3[$i]==1)
                {
                  $jum++;
                }
              }
              $c3c_b = array_sum($arr)/$jum;
              
               $q = $connection->createCommand()
      ->insert('hasil_centroid',[
        'c1a'=>$c1a_b,
      'c1b'=>$c1b_b,
        'c1c'=>$c1c_b,
        'c2a'=>$c2a_b,
                'c2b'=>$c2b_b,
                 'c2c'=>$c2c_b,
      'c3a'=>$c3a_b,
        'c3b'=>$c3b_b,
        'c3c'=>$c3c_b,

        ])
      ->execute();

              
              
              ?>
            </table>
            </div>
            </div>

         <p class="footer">Page rendered in <strong><?php echo Yii::getLogger()->getElapsedTime(); ?></strong> seconds</p>
        </div>
      </div>
    </div>
