<?php
namespace common\models;
use common\models\ValueHelpers;
use yii;
use yii\web\Controller;
use yii\helpers\Url;
Class PermissionHelpers
{
  public static function userMustBeOwner($model_name, $model_id)
{
$connection = \Yii::$app->db;
$userid = Yii::$app->user->identity->id;
$sql = "SELECT id FROM $model_name WHERE user_id=:userid AND id=:model_id";
$command = $connection->createCommand($sql);
$command->bindValue(":userid", $userid);
$command->bindValue(":model_id", $model_id);
if($result = $command->queryOne()) {
return true;
} else {
return false;
}
}
public static function requireStatus($status_name)
{
if ( Yii::$app->user->identity->status_id ==
ValueHelpers::getStatusValue($status_name)) {
return true;
} else {
return false;
}
}

public static function requireMinimumStatus($status_name)
{
if ( Yii::$app->user->identity->status_id >=
ValueHelpers::getStatusValue($status_name)) {
return true;
} else {
return false;
}
}

public static function requireRole($role_name)
{
if ( Yii::$app->user->identity->role_id ==
ValueHelpers::getRoleValue($role_name)) {
return true;
} else {
return false;
}
}
public static function requireMinimumRole($role_name)
{
if ( Yii::$app->user->identity->role_id >=
ValueHelpers::getRoleValue($role_name)) {
return true;
} else {
return false;
}
}
}
