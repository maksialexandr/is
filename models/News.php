<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @property string $image
 * @property string $date
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255,],
            [['content'], 'string'],
            [['date', 'content', 'name'], 'safe'],
            ['name', 'required', 'message' => 'Please choose a name.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'content' => 'Content',
            'image' => 'Image',
            'date' => 'Date',
        ];
    }
    
    public function getDate(){

        return Yii::$app->getFormatter()->format($this->date, 'date');
    }
    
    public function hasDate(){

        return !empty($this->date) ? true : false;
    }

    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('news_tag', ['news_id' => 'id']);
    }
    

    public function getDataItems()
    {
        return ArrayHelper::map(Tag::find()->all(), 'id', 'name');
    }

    public function setTags($tags)
    {
        $this->unlinkAll('tags');
        
        $tags = Tag::findAll($tags);
        foreach ($tags as $tag)
            $this->link('tags', $tag);
    }


}
