<?php
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use backend\models\Product;

class chartWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();

    }

    public function run(){

    		$data = new Product();
    	$data = $data->actionDynamichart();

        return $this->render('chartWidget',['data'=>$data]);
    }
}




?>
