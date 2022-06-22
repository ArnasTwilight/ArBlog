<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $content
 * @property string|null $description
 * @property string|null $date
 * @property string|null $image
 * @property int|null $viewed
 * @property int|null $status
 * @property int|null $user_id
 * @property int|null $category_id
 *
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'description'], 'string'],
            [['date'], 'safe'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['viewed', 'status', 'user_id', 'category_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'description' => 'Description',
            'date' => 'Date',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'status' => 'Status',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[ArticleTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTags()
    {
        return $this->hasMany(ArticleTag::className(), ['article_id' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }

    public static function getRecent() {
        return Article::find()->orderBy('date asc')->limit(3)->all();
    }

    public static function getPopular() {
        return Article::find()->orderBy('viewed asc')->limit(3)->all();
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function saveImage($filename)
    {
        $this->image = $filename;
        return $this->save(false);
    }

    public function getImage($id) {
        return ($this->image) ? '/uploads/article/' . $id . '/' . $this->image : '/uploads/article/no_image/no-image.jpg';
    }
}
