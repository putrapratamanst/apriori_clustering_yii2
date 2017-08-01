
public function actionAprioriku(){
   // $item = new BillOrderDetails();

 /*$connection = new \yii\db\Connection([
                'dsn' => 'mysql:host=localhost;dbname=internlagi',
                'username' => 'root',
                'password' => '',
                ]);
            $connection->open();
/* check connection */
//$result= $connection->createCommand("select name from product")->queryColumn();
//echo"<pre>";
//var_dump($result[0]);
//exit();
//$result []= $connection->createCommand("select name from product")->queryOne([]);
/*$query = new Query;

$count = Yii::$app->db->createCommand('
    SELECT COUNT(*) FROM product')->queryOne();


$provider = new ArrayDataProvider([
    'allModels' => $query->select(['code'])->from('product')->one(),
    'pagination' => [
        'pageSize' => 10,
    ],

]);
$rows = $provider->getModels();

$dataProvider = new SqlDataProvider([
    'sql' => 'SELECT * FROM product',
  //  'params' => [':status' => 1],
 //   'totalCount' => $count,
    //'pagination' => [
       // 'pageSize' => 10,
    //],
    'sort' => [
        'attributes' => [
            'name',
         //   'view_count',
           /// 'created_at',
        ],
    ],
]);
//$posts = ;
 // $listData=ArrayHelper::map($dataProvider,'code','name');
;
$counDt = Yii::$app->db->createCommand('
    SELECT name FROM product')->queryOne($fetchMode = \PDO::FETCH_NUM);



$dataProvider = new SqlDataProvider([
    'sql' => 'SELECT * FROM product',
  //  'params' => [':status' => 1],
   // 'totalCount' => $count,



]);
$row = [];
$rows=$dataProvider->getModels();


$posts = Product::find()->one();
    $data = ArrayHelper::toArray($posts,[
        'backend\models\Product' => [
          //  'code',
            'name',
            // the key name in array result => property name
          // /  'createTime' => 'created_at',
            // the key name in array result => anonymous function
           // 'length' => function ($post) {
              ///  return strlen($post->code);
           // },
        ],
    ]);
*/
//$count = Yii::$app->db->createCommand('
  //  SELECT name FROM product')->queryOne($fetchMode = \PDO::FETCH_COLUMN);

 /*$connection = new \yii\db\Connection([
                'dsn' => 'mysql:host=localhost;dbname=internlagi',
                'username' => 'root',
                'password' => '',
                ]);
            $connection->close();

$model = new \yii\db\Command;

$k=$model->query("SELECT name FROM product")->fetchColumn();


*/

 if($count = Yii::$app->db->createCommand('
    SELECT name FROM product')){

    

    //$item = $result->fetch_all();
    while ($i= $count->queryOne($fetchMode = \PDO::FETCH_COLUMN))
      {
        $item[] = $i[0];

        }
        

     }            
   //$count->close();
echo"<pre>";
  var_dump($item);
  exit;


if ($result = $connection->createCommand("select group_concat(product.name separator ',') from order_item left join product on (order_item.product_id = product.code) group by order_item.order_id")) {
    //$belian = $result->fetch_all();
    
    while ($b = $result->queryOne(\PDO::FETCH_NUM)) {
        $belian = $b[0];
    }


}

            $connection->close();

//echo '<pre>'.print_r( $item , true).'</pre>';
//echo '<pre>'.print_r( $belian , true).'</pre>';


    //$item = file('item.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
    //$belian = file('belian.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

    $item1 = count($item) - 1; // minus 1 from count
    $item2 = count($item);

    // MENDAPATKAN JUMLAH BARANG
    foreach ($item as $value) {
        $total_per_item[$value] = 0;
        foreach($belian as $item_belian) {            
            if(strpos($item_belian, $value) !== false) {
                $total_per_item[$value]++;
            }
        }
    }

    // MENDAPAT JUMLAH GABUNGAN
for($i = 0; $i < $item1; $i++) {
        for($j = $i+1; $j < $item2; $j++) {
            $item_pair = $item[$i].'|'.$item[$j]; 
            $item_array[$item_pair] = 0;
            foreach($belian as $item_belian) {
                if((strpos($item_belian, $item[$i]) !== false) && (strpos($item_belian, $item[$j]) !== false)) {
                    $item_array[$item_pair]++;
                }
            }
        }
    }

    
    // MENDAPATKAN KIRAAN UNTUK ASSOCIATION RULES
    foreach ($item_array as $ia_key => $ia_value) {
        $theitems = explode('|',$ia_key);
        for($x = 0; $x < count($theitems); $x++) {
            $item_name = $theitems[$x];
            $item_total = $total_per_item[$item_name];
            $in_float = $ia_value / $item_total;
            $in_percent = round($in_float * 100, 2);
            $alt_item = $theitems[ ($x + 1) % count($theitems)];
            echo "[+] $ia_key($ia_value) --> $item_name($item_total) => ". $in_float ."\r\n";
            echo "    ". $in_percent ."% yang membeli $item_name juga membeli $alt_item\r\n\r\n";
        }
    }

  return $this->render('apriori',['item'=>$item,'belian'=>$belian,'total_per_item'=>$total_per_item]);
}