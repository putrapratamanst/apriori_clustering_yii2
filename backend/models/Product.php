<?php

namespace backend\models;

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






public function actionDynamichart(){
  $db = \Yii::$app->db;
  $years = $db->createCommand('SELECT DISTINCT(predikat) FROM hasil ORDER BY id ASC')->queryColumn();


  $frameworks = $db->createCommand('select * from hasil INNER JOIN order_item on hasil.id_order_item = order_item.id WHERE predikat')->queryAll();

  $series=[];
  foreach ($frameworks as $framework) {
    $result = $db->createCommand('SELECT price from hasil INNER JOIN order_item on hasil.id_order_item = order_item.id WHERE predikat LIKE 
      "%'.$framework['predikat'].'" ORDER BY predikat ASC')->queryColumn();
    $data =  array_map('intval', $result);
    $series[]=[
    'name'=>$framework['name_product'],
    'data'=>$data,];
  }
  
} 








}

