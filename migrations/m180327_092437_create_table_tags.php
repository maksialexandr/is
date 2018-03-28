<?php

use yii\db\Migration;

/**
 * Class m180327_092437_create_table_tags
 */
class m180327_092437_create_table_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tags', [
            'id'        => $this->primaryKey(),
            'name'      => $this->string(255),
        ]);
        

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tags');
    }
}
