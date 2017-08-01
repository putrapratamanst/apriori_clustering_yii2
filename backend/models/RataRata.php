<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rata_rata".
 *
 * @property int $id
 * @property int $id_order_item
 * @property int $rata_rata
 *
 * @property OrderItem $orderItem
 */
class RataRata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rata_rata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_order_item', 'rata_rata'], 'required'],
            [['id_order_item', 'rata_rata'], 'integer'],
            [['id_order_item'], 'exist', 'skipOnError' => true, 'targetClass' => OrderItem::className(), 'targetAttribute' => ['id_order_item' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_order_item' => 'Id Order Item',
            'rata_rata' => 'Rata Rata',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItem()
    {
        return $this->hasOne(OrderItem::className(), ['id' => 'id_order_item']);
    }
}
