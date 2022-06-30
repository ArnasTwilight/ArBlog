<?php

use yii\db\Migration;

/**
 * Class m220630_174732_article_update
 */
class m220630_174732_article_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('article', 'date', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('article', 'date', $this->date());
    }
}
