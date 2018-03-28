<?php

use yii\db\Migration;

/**
 * Class m180327_100454_update_news_table
 */
class m180327_100454_update_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'news_id', 'integer');

        $this->createIndex(
            'idx-tag-news_id',
            'news',
            'news_id'
        );

        $this->addForeignKey(
            'fk-news-tag_id',
            'news',
            'news_id',
            'tags',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('news', 'tag_id');
        $this->dropIndex(
            'idx-tag-news_id',
            'news'
        );
    }

}
