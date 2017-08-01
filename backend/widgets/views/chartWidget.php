<?php
use miloschuman\highcharts\Highcharts;

?>   

<?php echo "<h1>Pola Pembelian Customer</h1>";

  $db = \Yii::$app->db;
  $years = $db->createCommand('SELECT DISTINCT(predikat) FROM hasil')->queryColumn();


  $frameworks = $db->createCommand('select * from order_item')->queryAll();

  $series=[];
  foreach ($frameworks as $framework) {
    $result = $db->createCommand('SELECT price from hasil INNER JOIN order_item on hasil.id_order_item = order_item.id WHERE quantity LIKE 
      "%'.$framework['quantity'].'" ORDER BY predikat ASC')->queryColumn();
    $data =  array_map('intval', $result);
    $series[]=[
    'name'=>$framework['name_product'],
    'data'=>$data,
    ];
  }

echo Highcharts::widget([
  'options'=>[
  'chart'=>['type'=>'column'],
  'title'=>['text'=>'Pola Pembelian Customer'],
 'xAxis'=>['categories'=>$years],
  'yAxis'=>['title'=>['text'=>'Usage(thousand)']],
  'series'=>$series,
  'plotOptions'=>[
  'column'=>[
  'dataLabels'=>[
  'enabled'=>'true',],],],],]);?>

  