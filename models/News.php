<?php

namespace app\models;

use Yii;
use yii\data\Sort;
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
            [['name'], 'string', 'max' => 255],
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

    /**
     * @return string
     */
    public function getDate(){

        return Yii::$app->getFormatter()->format($this->date, 'date');
    }

    /**
     * @return bool
     */
    public function hasDate(){

        return !empty($this->date) ? true : false;
    }

    /**
     * @return $this
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('news_tag', ['news_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getAllTags()
    {
        return ArrayHelper::map(Tag::find()->all(), 'id', 'name');
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags)
    {
        $this->unlinkAll('tags');
        foreach (Tag::findAll($tags) as $tag)
            $this->link('tags', $tag);
    }

    /**
     * @return Sort
     */
    public static function getSort()
    {
        return new Sort([
            'attributes' => [
                'date' => [
                    'asc' => ['date' => SORT_ASC],
                    'desc' => ['date' => SORT_DESC],
                    'label' => 'Date',
                ],
            ],
        ]);
    }

}
