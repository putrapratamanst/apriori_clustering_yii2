<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "pembayaran".
 *
 * @property int $id
 * @property int $user_id
 * @property string $file
 */
class Pembayaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
                public $upload_folder ='uploads';

    public static function tableName()
    {
        return 'pembayaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'file'], 'required'],
            [['user_id'], 'integer'],
            [['file'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'file' => 'File',
        ];
    }
    
public function getUploadPath(){
  return Yii::getAlias('@webroot').'/'.$this->upload_folder.'/';
}

public function getUploadUrl(){
  return Yii::getAlias('@web').'/'.$this->upload_folder.'/';
}

public function getImageViewer(){
  return empty($this->file) ? Yii::getAlias('@web').'/img/none.png' : $this->getUploadUrl().$this->file;
}
public function upload($model,$attribute)
{
    $file  = UploadedFile::getInstance($model, $attribute);
      $path = $this->getUploadPath();
    if ($this->validate() && $file !== null) {

        $fileName = md5($file->baseName.time()) . '.' . $file->extension;
        //$fileName = $file->baseName . '.' . $file->extension;
        if($file->saveAs($path.$fileName)){
          return $fileName;
        }
    }
    return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
}



}
