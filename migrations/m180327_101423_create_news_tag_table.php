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


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('news_tag');
    }
}
