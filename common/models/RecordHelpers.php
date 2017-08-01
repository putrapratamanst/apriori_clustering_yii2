<?php
namespace common\models;
use yii;
Class RecordHelpers
{
public static function userHas($model_name)
{
$connection = \Yii::$app->db;
$userid = Yii::$app->user->identity->id;
$sql = "SELECT id FROM `$model_name` WHERE 'user_id'=:userid";
$command = $connection->createCommand($sql);
$command->bindValue(":userid", $userid);
$result = $command->queryOne();
if ($result == null) {
return false;
} else {
return $result['id'];
}
}


    public static function userHave($model_name)
{
$connection = \Yii::$app->db;
$userid = Yii::$app->user->identity->id;
$sql = "SELECT id FROM $model_name WHERE id_mahasiswa=:userid";
$command = $connection->createCommand($sql);
$command->bindValue(":userid", $userid);
$result = $command->queryOne();
if ($result == null) {
return false;
} else {
return $result['id'];
}
}
 public static function userHad($model_name)
{
$connection = \Yii::$app->db;
$userid = Yii::$app->user->identity->id;
$sql = "SELECT * FROM $model_name WHERE id=:userid";
$command = $connection->createCommand($sql);
$command->bindValue(":userid", $userid);
$result = $command->queryOne();
if ($result == null) {
return false;
} else {
return $result['id'];
}
}



}
