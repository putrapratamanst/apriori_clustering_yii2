<?php
use miloschuman\highcharts\Highcharts;

?>   

<?php echo "<h1>Pola Pembelian Customer</h1>";

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

  