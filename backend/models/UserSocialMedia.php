<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_social_media".
 *
 * @property int $user_id
 * @property string $id
 * @property int $created_at
 * @property string $social_media
 * @property int $update_at
 * @property string $username
 *
 * @property User $user
 */
class UserSocialMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_social_media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'id', 'social_media', 'username'], 'required'],
            [['user_id', 'created_at', 'update_at'], 'integer'],
            [['social_media'], 'string'],
            [['id'], 'string', 'max' => 100],
            [['username'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'id' => 'ID',
            'created_at' => 'Created At',
            'social_media' => 'Social Media',
            'update_at' => 'Update At',
            'username' => 'Username',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
