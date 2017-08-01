<?php

namespace frontend\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property string $code
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property int $category_id
 * @property string $price
 * @property string $suggested_use
 * @property string $image
 *
 * @property Category $category
 * @property Stock[] $stocks
 */
class Product extends \yii\db\ActiveRecord implements CartPositionInterface
{
    use CartPositionTrait;
        public $upload_folder ='uploads';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }
 public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['description', 'suggested_use'], 'string'],
            [['category_id'], 'integer'],
            [['code'], 'string', 'max' => 30],
            [['name', 'slug'], 'string', 'max' => 255],
            [['price'], 'string', 'max' => 20],
  [['image'], 'file','extensions' => 'png, jpg, jpeg, gif','skipOnEmpty' => true, 'on' => 'update'],

         [['code'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'category_id' => 'Category ID',
            'price' => 'Price',
            'suggested_use' => 'Suggested Use',
            'image' => 'Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['code_product' => 'code']);
    }
 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->code;
    }
 
public function getUploadPath(){
  return Yii::getAlias('@webroot').'/'.$this->upload_folder.'/';
}

public function getUploadUrl(){
  return Yii::getAlias('@web').'/'.$this->upload_folder.'/';
}

public function getImageViewer(){
  return empty($this->image) ? Yii::getAlias('@web').'/img/none.png' : $this->getUploadUrl().$this->image;
}
public function upload($model,$attribute)
{
    $image  = UploadedFile::getInstance($model, $attribute);
      $path = $this->getUploadPath();
    if ($this->validate() && $image !== null) {

        $fileName = md5($image->baseName.time()) . '.' . $image->extension;
        //$fileName = $image->baseName . '.' . $image->extension;
        if($image->saveAs($path.$fileName)){
          return $fileName;
        }
    }
    return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
}



 public function getProductBy(){
        $data = Product::find()->asArray()->limit(3)->orderBy('rand()')->all();
        return $data;
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

$associator->train($result, $labels);

$associator->predict(['ARICRYL 7001']);

$associator->getRules();

$associator->apriori();






    return $this->render('widgets/view/aprioria',['associator'=>$associator]);

}


}

