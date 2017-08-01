<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use frontend\models\Product;
use Phpml\Association\Apriori;

class aprioriWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();

    }

    public function run(){

    		$data = new Product();
    	$data = $data->getProductBy();
$sampless = [['ARICRYL 7101 PT','UNIMER 1314 C','ARICRYL 7001'],
['ARICRYL 7101 PT','UNIMER 1314 C','UNITHANE 2530 L'
],['UNIMER 1417 D','UNITHANE 2530 L'],
['UNIMER 1314 C','UNIMER 1417 D','UNITHANE 2530 L'
],
['ARICRYL 7101 PT','UNIMER 1314 C','UNIMER 1417 D','ARICRYL 7001','UNITHANE 2530 L'
],
['UNITHANE 2530 L'
],
['ARICRYL 7101 PT','UNIMER 1417 D'
],
['ARICRYL 7101 PT','UNIMER 1417 D','ARICRYL 7001'
],
['UNITHANE 2530 L'
],
['UNIMER 1417 D','UNITHANE 2530 L'
],
['UNIMER 1417 D','UNITHANE 2530 L'
],
['ARICRYL 7101 PT','UNITHANE 2530 L'
],
['ARICRYL 7101 PT','UNIMER 1314 C','ARICRYL 7001'
],
['UNIMER 1417 D','ARICRYL 7001','UNITHANE 2530 L'
],
['ARICRYL 7101 PT','ARICRYL 7001','UNITHANE 2530 L'
],
['UNIMER 1314 C','UNIMER 1417 D','ARICRYL 7001'
],
['ARICRYL 7101 PT','UNIMER 1417 D'
],
['ARICRYL 7001','UNITHANE 2530 L'
],
['ARICRYL 7101 PT','UNIMER 1314 C','UNIMER 1417 D'
],
['ARICRYL 7001','UNITHANE 2530 L'
],
['ARICRYL 7101 PT','UNIMER 1314 C','UNIMER 1417 D'
],
['ARICRYL 7101 PT','UNIMER 1417 D','UNITHANE 2530 L'
],
['UNIMER 1314 C','UNIMER 1417 D','UNITHANE 2530 L'
],
['ARICRYL 7101 PT'
],
['UNIMER 1417 D','UNITHANE 2530 L'
],
['ARICRYL 7101 PT','ARICRYL 7001'
],
['UNIMER 1314 C','UNIMER 1417 D','UNITHANE 2530 L'
],
['ARICRYL 7101 PT','UNITHANE 2530 L'
],
['ARICRYL 7001','UNITHANE 2530 L'
],
['UNIMER 1417 D','ARICRYL 7001','UNITHANE 2530 L'
],
['UNIMER 1314 C','ARICRYL 7001'
]];


//$belian= file('uploads/belian.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

$labels  = [];
   // $sampless = new Order();
    //$sampless = [OrderItem::find()->all()];

    // $array = ArrayHelper::map($sampless,'product_id','id');

    $associator = new Apriori($support = 0.5, $confidence = 0.5);

$associator->train($sampless, $labels);

$associator->predict(['ARICRYL 7001']);

$associator->getRules();

$associator->apriori();

        return $this->render('aprioriWidget',['data'=>$data]);
    }
}




?>
