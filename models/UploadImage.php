<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadImage extends Model
{
    /**
     * @var UploadedFile
     */
    public $image;

    public function rules()
    {
        return [
            [['image'], 'file', 'extensions' => 'png, jpg']
        ];
    }

    /**
     * @return null|string
     */
    public function upload(){
        if($this->validate()) {
            $nameFile = 'uploads/' . uniqid() . sha1($this->image->baseName) . '.' . $this->image->extension;
            $this->image->saveAs($nameFile);
            return $nameFile;
        }
        else
            return null;

    }

    /**
     * @param $image
     */
    public static function deleteOldImage($image)
    {
        if ($image)
            if (file_exists(Yii::$app->basePath . '/web/' . $image))
                unlink(Yii::$app->basePath . '/web/' . $image);

    }

}