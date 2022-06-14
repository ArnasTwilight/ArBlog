<?php

use yii\db\Migration;

/**
 * Class m220614_174507_articles
 */
class m220614_174507_article extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}',[
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => $this->text(),
            'description' => $this->text(),
            'date' => $this->date(),
            'image' => $this->string(),
            'viewed' => $this->integer(),
            'status' => $this->integer()->defaultValue(1),
            'user_id' => $this->integer(),
            'category_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
