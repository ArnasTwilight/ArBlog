<?php

use yii\db\Migration;

/**
 * Class m220625_064100_user_update
 */
class m220625_064100_user_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('user', 'about', $this->text());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'about');
    }
}
