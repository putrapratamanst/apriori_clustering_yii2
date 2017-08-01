<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;

class TestController extends Controller{

	public function actionGetProvince($id=0){
		$client = new Client();
		$addUrl = ($id>0)?'id='.$id:'';
		$response = $client->createRequest()->setFormat(Client::FORMAT_JSON)->setMethod('get')->
		setUrl('http://api.rajaongkir.com/starter/province?'.$addUrl)->
		addHeaders([
			'key'=>'49c6c540eb4d51d81581f260aa66b877',])->send();

		if($response->isOk){
			$content = \Yii\helpers\Json::decode($response->content);
			//$content['rajaongkir']['query']
			//$content['rajaongkir']['status']
			$results = $content['rajaongkir']['results'];

			if($id>0){
				echo $results['province_id'] . '-';
				echo $results['province'] . '<br>';
			}else{
				echo "blank";
			}
		}else{
			foreach ($results as $provinces) {
				echo $provinces['province_id']."-".$provinces['province']."<br>";
							}
		}


	}else{
		$content = \Yii\helpers\Json::decode($response->content);
		echo $content['rajaongkir'['status']['description'];
	}




}