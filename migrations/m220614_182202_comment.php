<?php

use yii\db\Migration;

/**
 * Class m220614_182202_comment
 */
class m220614_182202_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}',[
            'id' => $this->primaryKey(),
            'text' => $this->text(),
            'user_id' => $this->integer(),
            'article_id' => $this->integer(),
            'status' => $this->integer(),
            'date' => $this->date(),
        ]);

        // create index for column 'user_id'
        $this->createIndex(
            'idx-user_id',
            'comment',
            'user_id'
        );
        // add foreign key for table 'user'
        $this->addForeignKey(
            'fk-user_id',
            'comment',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // create index for column 'article_id'
        $this->createIndex(
            'idx-article_id',
            'comment',
            'article_id'
        );

        // add foreign key for table 'article'
        $this->addForeignKey(
            'fk-comment-article_id',
            'comment',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }
}
