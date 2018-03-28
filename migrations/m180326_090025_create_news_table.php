<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m180326_090025_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news', [
            'id'        => $this->primaryKey(),
            'name'      => $this->string(255),
            'content'   => $this->text(),
            'image'     => $this->string(255),
            'date'      => $this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('news');
    }
}
