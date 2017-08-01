<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use Phpml\Association\Apriori;
use backend\models\Order;
use backend\models\OrderItem;
use yii\helpers\ArrayHelper;
use yii\db\Query;
use backend\models\Product;
use yii\db\mysql\Schema;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\SqlDataProvider;
use yii\base\Component;
use yii\base\NotSupportedException;
use yii\db\Command;
/**
 * Site controller
 */
class SiteController extends Controller
{
        public $fetchMode = \PDO::FETCH_ASSOC;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','aprioriku','apriori'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
       public function actionAprioriku()
    {

        return $this->render('apriori');
    }


    public function actionApriori(){
     $connection = new \yii\db\Connection([
                'dsn' => 'mysql:host=localhost;dbname=internlagi',
                'username' => 'root',
                'password' => '',
                ]);
            $connection->open();
            $name_product ="ARICRYL 7101 PT";
       $samples=$connection->createCommand("select group_concat(product.name separator ',') from order_item left join product on (order_item.product_id = product.code) group by order_item.order_id")->queryAll(\PDO::FETCH_NUM);


       $samples=$connection->createCommand("SELECT product.name, order_item.name_product FROM product LEFT JOIN order_item ON product.code=order_item.id ORDER BY product.name ")->queryAll([\PDO::FETCH_NUM]);


             


       $baru[]= $connection->createCommand("Select name_product from order_item where order_id=10")->queryall(\PDO::FETCH_NUM);
       
    

     //  if ($result = $connection->createCommand("select group_concat(product.name separator ',') from order_item left join product on (order_item.product_id = product.code) group by order_item.order_id")) {
    //$belian = $result->fetch_all();
    


/*echo "<pre>";
       var_dump($samples);
       exit();*/
  
//$arr=explode(",",$samples);
// print_r($arr);
       // /echo "<pre>";

    //   $ku = $samples;
     // $la= explode(",", $ku[0]);
     
/* 
$result= $connection->createCommand("Select name_product from order_item");
$results = [];
while($row = $result->queryAll(\PDO::FETCH_ASSOC))
{
   $results[] = $row;
}
*/

$result= $connection->createCommand("select name, order_item.name_product from product LEFT join order_item on product.code=order_item.product_id ");

while ($row = $result->queryAll()) {
  //  echo $row[0];

    echo "<pre>";
    var_dump($row);
exit();
}

$sampless = [['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta',], ['alpha', 'beta', 'epsilon','coek'], ['coek','alpha', 'beta', 'theta'],];


//$belian= file('uploads/belian.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

$labels  = [];
   // $sampless = new Order();
    //$sampless = [OrderItem::find()->all()];

    // $array = ArrayHelper::map($sampless,'product_id','id');

    $associator = new Apriori($support = 0.5, $confidence = 0.5);

$associator->train($result, $labels);

$associator->predict(['theta','beta']);

$associator->getRules();

$associator->apriori();






    return $this->render('aprioria',['associator'=>$associator]);

}

}