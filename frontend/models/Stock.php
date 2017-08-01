<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property int $id
 * @property string $code_product
 * @property int $qty
 *
 * @property Product $codeProduct
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code_product'], 'required'],
            [['qty'], 'integer'],
            [['code_product'], 'string', 'max' => 30],
            [['code_product'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['code_product' => 'code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code_product' => 'Code Product',
            'qty' => 'Qty',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodeProduct()
    {
        return $this->hasOne(Product::className(), ['code' => 'code_product']);
    }
}
