<?php

use yii\db\Migration;

/**
 * Class m220703_140743_comment_update
 */
class m220703_140743_comment_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('comment', 'date', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('comment', 'date', $this->date());
    }
}
