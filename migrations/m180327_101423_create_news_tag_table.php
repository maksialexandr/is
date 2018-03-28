<?php

use yii\db\Migration;

/**
 * Class m180327_092437_create_table_tags
 */
class m180327_101423_create_news_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news_tag', [
            'id'        => $this->primaryKey(),
            'news_id'   => $this->integer(),
            'tag_id'    => $this->integer(),
        ]);

        $this->createIndex(
            'idx-news_tag-tag_id',
            'news_tag',
            'tag_id'
        );

        $this->addForeignKey(
            'fk-news_tag-tag_id',
            'news_tag',
            'tag_id',
            'tags',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-news_tag-news_id',
            'news_tag',
            'news_id'
        );

        $this->addForeignKey(
            'fk-news_tag-news_id',
            'news_tag',
            'news_id',
            'news',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-news_tag-tag_id', 'news_tag');

        $this->dropIndex(
            'idx-news_tag-tag_id',
            'news_tag'
        );

        $this->dropForeignKey('fk-news_tag-news_id', 'news_id');

        $this->dropIndex(
            'idx-news_tag-news_id',
            'news_tag'
        );

        $this->dropTable('news_tag');
    }
}
