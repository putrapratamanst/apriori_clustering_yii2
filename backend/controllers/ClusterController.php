<?php
namespace backend\controllers; 

use backend\models\BillOrders;
use backend\models\OrderItem;
use yii\web\Session; 
use yii\web\Controller; 
use yii\db\Expression;
use backend\models\Product;
use yii\db\QueryBuilder;
use backend\models\RataRata;

class ClusterController extends Controller { 
	

	public function actionGenerateawal() 
	{
		
 $connection = new \yii\db\Connection([
                'dsn' => 'mysql:host=localhost;dbname=internlagi',
                'username' => 'root',
                'password' => '',
                ]);
            $connection->open();
        $dataproducts = $connection->createCommand('SELECT order_item.id,order_item.name_product, order_item.price, stock.qty AS stock, SUM(quantity) AS quantity FROM order_item INNER JOIN stock ON order_item.product_id=stock.code_product GROUP BY name_product ORDER BY id')->queryAll();
        //SELECT name_product, SUM(quantity),COUNT(*) FROM order_item GROUP BY name_product HAVING(COUNT(name_product) >= 1 )
        // SELECT order_item.name_product, stock.qty AS stock, SUM(quantity) FROM order_item INNER JOIN stock ON order_item.product_id=stock.code_product GROUP BY name_product 
        //SELECT order_item.name_product, stock.qty, order_item.quantity FROM order_item INNER JOIN stock ON order_item.product_id=stock.code_product
		
		$data = OrderItem::find()->all();


		return $this->render('generate_awal', ['dataproducts' => $dataproducts ]); }



		public function actionGeneraterata() {

			$dataproducts = new OrderItem();


 $connection = new \yii\db\Connection([
                'dsn' => 'mysql:host=localhost;dbname=internlagi',
                'username' => 'root',
                'password' => '',
                ]);
            $connection->open();
        $dataproducts = $connection->createCommand('SELECT order_item.id,order_item.name_product, order_item.price, stock.qty AS stock, SUM(quantity) AS quantity FROM order_item INNER JOIN stock ON order_item.product_id=stock.code_product GROUP BY name_product ORDER BY id')->queryAll();

			$count = OrderItem::find()->count();

					$v = "";

if($count<0)

		{
						foreach ($dataproducts as $s) {
		
				$nilai =floor(($s['quantity']+$s['price']+$s['stock'])/3);

$connection = new \yii\db\Connection([
					'dsn' => 'mysql:host=localhost;dbname=internlagi',
					'username' => 'root',
					'password' => '',
					]);
				$connection->open();
				$command = $connection->createCommand()
				->insert('rata_rata',[
					'id_order_item'=>$s['id'],
					'rata_rata'=>$nilai])
				->execute();
						}
		} else {
			/*->leftJoin('rata_rata', '`rata_rata`.`id` = `products`.`id`')->with('rataRatas')*/
			$user = \Yii::$app->db->createCommand()->truncateTable('rata_rata')->execute();


			foreach ($dataproducts as $s) {

				$nilai = floor(($s['quantity']+$s['price']+$s['stock'])/3);
				
				$connection = new \yii\db\Connection([
					'dsn' => 'mysql:host=localhost;dbname=internlagi',
					'username' => 'root',
					'password' => '',
					]);
				$connection->open();
				$command = $connection->createCommand()
				->insert('rata_rata',[
					'id_order_item'=>$s['id'],
					'rata_rata'=>$nilai])
				->execute();


			}
}
$connection = new \yii\db\Connection([
                'dsn' => 'mysql:host=localhost;dbname=internlagi',
                'username' => 'root',
                'password' => '',
                ]);
            $connection->open();
        $dataproducts = $connection->createCommand('SELECT SUM(quantity) AS quantity, order_item.id,order_item.name_product, order_item.price, rata_rata.rata_rata,  stock.qty AS stock  FROM order_item LEFT JOIN (stock,rata_rata) on
        order_item.product_id=stock.code_product and
        	 order_item.id=rata_rata.id_order_item  GROUP BY name_product ORDER BY id ')->queryAll();


			return $this->render('generate_rata', ['dataproducts' => $dataproducts,

				]);
		}





		public function actionGeneratecentroid() {
		$kluster = 3;
	$data['c1'] = rand(9000,15000);
		$data['c2'] = rand(4000,8000);
		$data['c3'] = rand(1000,3000);
			
 $connection = new \yii\db\Connection([
                'dsn' => 'mysql:host=localhost;dbname=internlagi',
                'username' => 'root',
                'password' => '',
                ]);
            $connection->open();
        $dataproducts = $connection->createCommand('SELECT SUM(quantity) AS quantity, order_item.id,order_item.name_product, order_item.price, rata_rata.rata_rata, stock.qty AS stock FROM order_item left join (rata_rata,stock) on order_item.id=rata_rata.id_order_item and order_item.product_id=stock.code_product GROUP by name_product ')->queryAll();
		$st = "";


/*		$dataproducts = Products::find()
		    ->select('*')
		    ->leftJoin('rata_rata', '`products`.`id` = `rata_rata`.`id_product`')
		    ->with('rataRatas')
		    ->all();
		    	*/
//$dataproducts = Products::find()->all();


		    $user = \Yii::$app->db->createCommand()->truncateTable('hasil')->execute();

		    foreach ($dataproducts as $s ) {
		    	$d1 = abs($s['rata_rata']-$data['c1']); //96-90 = 6
			$d2 = abs($s['rata_rata']-$data['c2']); // 78 - 75 = 3
			$d3 = abs($s['rata_rata']-$data['c3']);

		    	$array_sort_awal = [$d1,$d2,$d3];

		    	$array_sort = $array_sort_awal;
			for ($j=1;$j<=$kluster-1;$j++){//1 4 --> 2
				for ($k=0;$k<=$kluster-2;$k++) {//0 2 --> 1
					if ($array_sort[$k] > $array_sort[$k + 1]){ // $array_sort[0] > $array_sort[1] --> 6 > 3
						$temp = $array_sort[$k]; // 3
						$array_sort[$k] = $array_sort[$k + 1]; // 4
						$array_sort[$k + 1] = $temp; //$array_sort[1] = 4
					}
				}
			}

			for ($i = 0; $i < $kluster; $i++){
				for($r = 0; $r < $kluster; $r++)
				{
					if($array_sort[0]==$array_sort_awal[$r])
					{
						if($r==0) $st =  "Fast Moving";
						else if($r==1) $st =  "Slow Moving";
						else if($r==2) $st =  "Dead Stock";

					}
				}
			}

			$connection = new \yii\db\Connection([
				'dsn' => 'mysql:host=localhost;dbname=internlagi',
				'username' => 'root',
				'password' => '',
				]);
			$connection->open();
			$command = $connection->createCommand()
			->insert('hasil',[
				'id_order_item'=>$s['id'],
				'predikat'=>$st,
				'd1'=>$d1,
				'd2'=>$d2,
				'd3'=>$d3,
				])
			->execute();

$connection = new \yii\db\Connection([
				'dsn' => 'mysql:host=localhost;dbname=internlagi',
				'username' => 'root',
				'password' => '',
				]);
		 $connection->open();
        $dataproducts = $connection->createCommand('SELECT SUM(quantity) AS quantity, order_item.id,order_item.name_product, order_item.price, rata_rata.rata_rata,  stock.qty AS stock, hasil.d1, hasil.d2, hasil.d3, hasil.predikat FROM order_item LEFT JOIN (rata_rata,hasil,stock) on order_item.id=rata_rata.id_order_item and order_item.id=hasil.id_order_item and order_item.product_id=stock.code_product GROUP BY name_product ORDER BY id ')->queryAll();


		}


		return $this->render('generate_centroid', ['data' => $data,'dataproducts' => $dataproducts ]); }




	public function actionIterasikmeans() {


$connection = new \yii\db\Connection([
                'dsn' => 'mysql:host=localhost;dbname=internlagi',
                'username' => 'root',
                'password' => '',
                ]);
            $connection->open();
        $dataproducts = $connection->createCommand('SELECT SUM(quantity) AS quantity, order_item.id,order_item.name_product, order_item.price, rata_rata.rata_rata,  stock.qty AS stock  FROM order_item LEFT JOIN (stock,rata_rata) on
        order_item.product_id=stock.code_product and
        	 order_item.id=rata_rata.id_order_item  GROUP BY name_product ORDER BY id')->queryAll();

		return $this->render('iterasi_kmeans', ['dataproducts' => $dataproducts, ]); }









			public function actionIterasikmeanslanjut() {

$connection = new \yii\db\Connection([
                'dsn' => 'mysql:host=localhost;dbname=internlagi',
                'username' => 'root',
                'password' => '',
                ]);
            $connection->open();
        $dataproducts= $connection->createCommand('SELECT SUM(quantity) AS quantity, order_item.id,order_item.name_product, order_item.price, rata_rata.rata_rata,  stock.qty AS stock  FROM order_item LEFT JOIN (stock,rata_rata) on
        order_item.product_id=stock.code_product and
        	 order_item.id=rata_rata.id_order_item  GROUP BY name_product ORDER BY id')->queryAll();


			$connection = new \yii\db\Connection([
				'dsn' => 'mysql:host=localhost;dbname=internlagi',
				'username' => 'root',
				'password' => '',
				]);
			$connection->open();
					//$id = "";

			$id = $connection->createCommand('SELECT max(nomor) as m FROM hasil_centroid')->queryAll();

		foreach($id as $i)
		{
			$id = $i['m'];
		}

		$rows = (new \yii\db\Query())
    ->select('*')
    ->from('hasil_centroid')
    ->where(['nomor' => $id])
    ->all();

$centroid= $connection->createCommand('SELECT * FROM hasil_centroid')->queryAll();

		$a= $id+1;
		//$it = "";


			$connection = new \yii\db\Connection([
				'dsn' => 'mysql:host=localhost;dbname=internlagi',
				'username' => 'root',
				'password' => '',
				]);
			$connection->open();	

			$it = $connection->createCommand('SELECT MAX(iterasi) as it FROM centroid_temp')->queryAll();

		
		foreach($it as $i)
		{
			$it = $i['it'];
		}
		
		
		$it_temp = $it-1;

		$it_sebelum =  $connection->createCommand('SELECT * FROM centroid_temp JOIN hasil_centroid where iterasi=:iterasi')->bindValue(':iterasi',$it_temp)->queryAll();

	

	

		$c1_sebelum = array();
		$c2_sebelum = array();
		$c2_sebelum = array();
		$no=0;
		
		foreach($it_sebelum as $it_prev)
		{
			$c1_sebelum[$no] = $it_prev['c1'];
			$c2_sebelum[$no] = $it_prev['c2'];
			$c3_sebelum[$no] = $it_prev['c3'];
			$no++;
		}


		$it_sesudah =  $connection->createCommand('SELECT * FROM centroid_temp JOIN hasil_centroid WHERE iterasi=:iterasi')->bindValue(':iterasi',$it)->queryAll();

  



		$c1_sesudah = array();
		$c2_sesudah = array();
		$c2_sesudah = array();
		$no=0;
		foreach($it_sesudah as $it_next)
		{
			$c1_sesudah[$no] = $it_next['c1'];
			$c2_sesudah[$no] = $it_next['c2'];
			$c3_sesudah[$no] = $it_next['c3'];
			$no++;
		}



if($c1_sebelum==$c1_sesudah AND $c2_sebelum==$c2_sesudah AND $c3_sebelum==$c3_sesudah)
		{ 
		?>
			<script>
					alert("Proses iterasi berakhir pada tahap ke-<?php echo $it; ?>");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".\Yii::$app->homeUrl."?r=cluster%2Fiterasikmeanshasil'>";
		}
			 else
			 {


		$dataproducts= $connection->createCommand('SELECT SUM(quantity) AS quantity, order_item.id,order_item.name_product, order_item.price, rata_rata.rata_rata,  stock.qty AS stock  FROM order_item LEFT JOIN (stock,rata_rata) on
        order_item.product_id=stock.code_product and
        	 order_item.id=rata_rata.id_order_item  GROUP BY name_product ORDER BY id')->queryAll();




								return $this->render('iterasi_kmeans_lanjut', ['dataproducts' => $dataproducts,'centroid'=>$centroid, 'a'=>$a]); 
}


	}



public function actionIterasikmeanshasil() {


$connection = new \yii\db\Connection([
				'dsn' => 'mysql:host=localhost;dbname=internlagi',
				'username' => 'root',
				'password' => '',
				]);
			$connection->open();
			$datahasil = $connection->createCommand('select * from hasil INNER JOIN order_item on hasil.id_order_item = order_item.id order by d3 DESC')->queryAll();
			
		$data['q'] = $connection->createCommand('select * from centroid_temp group by iterasi')->queryAll();


		return $this->render('iterasi_kmeans_hasil', ['datahasil' => $datahasil, 'data'=>$data ]); }







public function actionDynamichart(){
	$db = \Yii::$app->db;
	$years = $db->createCommand('SELECT DISTINCT(predikat) FROM hasil ORDER BY id ASC')->queryColumn();


	$frameworks = $db->createCommand('select * from hasil INNER JOIN order_item on hasil.id_order_item = order_item.id WHERE predikat')->queryAll();

	$series=[];
	foreach ($frameworks as $framework) {
		$result = $db->createCommand('SELECT price from hasil INNER JOIN order_item on hasil.id_order_item = order_item.id WHERE predikat LIKE 
			"%'.$framework['predikat'].'" ORDER BY predikat ASC')->queryColumn();
		$data =  array_map('intval', $result);
		$series[]=[
		'name'=>$framework['name_product'],
		'data'=>$data,];
	}
	return $this->render('chart',[
		'years'=>$years,
		'series'=>$series
		]);
} 







}
