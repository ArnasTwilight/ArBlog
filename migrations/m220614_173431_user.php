<?php

use yii\db\Migration;

/**
 * Class m220614_173431_user
 */
class m220614_173431_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string(),
            'login' => $this->string(),
            'password' => $this->string(),
            'image' => $this->string()->defaultValue(null),
            'isAdmin' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
