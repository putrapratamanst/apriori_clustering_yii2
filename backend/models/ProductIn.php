<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_in".
 *
 * @property int $id
 * @property string $id_product
 * @property int $qty
 *
 * @property Product $product
 */
class ProductIn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_in';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qty'], 'integer'],
            [['id_product'], 'string', 'max' => 30],
            [['id_product'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['id_product' => 'code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_product' => 'Id Product',
            'qty' => 'Qty',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['code' => 'id_product']);
    }
}
