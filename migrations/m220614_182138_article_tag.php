<?php

use yii\db\Migration;

/**
 * Class m220614_182138_article_tag
 */
class m220614_182138_article_tag extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article_tag}}',[
            'id' => $this->primaryKey(),
            'tag_id' => $this->integer(),
            'article_id' => $this->integer(),
        ]);

        // creates index for column 'tag_id'
        $this->createIndex(
            'idx-tag_id',
            'article_tag',
            'tag_id'
        );

        // add foreign key for table 'tag'
        $this->addForeignKey(
            'fk-tag_id',
            'article_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );

        // creates index for column 'article_id'
        $this->createIndex(
            'idx-article_id',
            'article_tag',
            'article_id'
        );

        // add foreign key for table 'article'
        $this->addForeignKey(
            'fk-article_tag-article_id',
            'article_tag',
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
        $this->dropTable('{{%article_tag}}');
    }
}
