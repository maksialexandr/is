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
        $this->addColumn('news', 'tag_id', 'integer');

        $this->createIndex(
            'idx-news-tag_id',
            'news',
            'tag_id'
        );

        $this->addForeignKey(
            'fk-news-tag_id',
            'news',
            'tag_id',
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
        $this->dropForeignKey('fk-news-tag_id', 'news');

        $this->dropIndex(
            'idx-news-tag_id',
            'news'
        );

        $this->dropColumn('news', 'tag_id');

    }

}
