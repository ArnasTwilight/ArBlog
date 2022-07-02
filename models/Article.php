<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
use yii\db\ActiveRecord;

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
class Article extends ActiveRecord
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
            [['date'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['viewed', 'status', 'user_id', 'category_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            ['title', 'required'],
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

    public static function getRecent($number = 3) {
        return Article::find()->orderBy('date desc')->limit($number)->all();
    }

    public static function getPopular($number = 3) {
        return Article::find()->orderBy('viewed desc')->limit($number)->all();
    }

    public static function getAll($pageSize = 3)
    {
        $query = Article::find();
        $count = $query->count();

        $data = Article::getPagination($query, $count, $pageSize);

        return $data;
    }

    public static function getAllPostCategory($categoryId, $pageSize = 3)
    {
        $query = Article::find()->where(['category_id' => intval($categoryId)]);
        $count = $query->count();

        $data = Article::getPagination($query, $count, $pageSize);

        return $data;
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

    public function getDate() {
        return Yii::$app->formatter->asDatetime($this->date);
    }

    public function viewedCounter () {
        $this->viewed += 1;
        return $this->save(false);
    }

    public static function nonePostInCategory ($categoryName)
    {
        $error = '
         <div class="error-block">
            <div>
                <p>No posts in '. $categoryName .' category</p>
            </div>
        </div>';

        return $error;
    }

    private static function getPagination ($query, $count, $pageSize)
    {
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);

        $articles = $query->offset($pagination->offset)
            ->orderBy('date desc')
            ->limit($pagination->limit)
            ->all();

        $data['articles'] = $articles;
        $data['pagination'] = $pagination;

        return $data;
    }
}
