<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

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
            [['title', 'description'], 'string', 'min' => 1, 'max' => 255],
            [['title', 'content', 'description'], 'required'],
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

    public static function getRecent($number = 3)
    {
        return Article::find()->orderBy('date desc')->limit($number)->all();
    }

    public static function getPopular($number = 3)
    {
        return Article::find()->orderBy('viewed desc')->limit($number)->all();
    }

    public static function getAll($pageSize = 3)
    {
        $query = Article::find();
        $count = $query->count();

        $data = PaginationSite::getPagination($query, $count, $pageSize);

        return $data;
    }

    public static function getAllPostCategory($categoryId, $pageSize = 3)
    {
        $query = Article::find()->where(['category_id' => intval($categoryId)]);
        $count = $query->count();

        $data = PaginationSite::getPagination($query, $count, $pageSize);

        return $data;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable('article_tag', ['article_id' => 'id']);
    }

    public function getSelectedTags($element = 'id')
    {
        if ($element === 'all') {
            $selected = $this->getTags()->all();
            return $selected;
        }

        $selected = $this->getTags()->select($element)->asArray()->all();
        return ArrayHelper::getColumn($selected, $element);
    }

    public function saveImage($filename)
    {
        $this->image = $filename;
        return $this->save(false);
    }

    public function saveTags($tags)
    {
        if (is_array($tags)) {
            $this->clearCurrentTags();

            foreach ($tags as $tag_id) {
                $tag = Tag::findOne($tag_id);
                $this->link('tags', $tag);
            }
        }
    }

    public function saveCategory($category)
    {
        $category = Category::findOne($category);
        $this->link('category', $category);
    }

    public function clearCurrentTags()
    {
        ArticleTag::deleteAll(['article_id' => $this->id]);
    }

    public function getImage()
    {
        return ($this->image) ? '/uploads/' . Yii::$app->params['article.dirImage'] . '/' . $this->id . '/' . $this->image : Yii::$app->params['article.NoImage'];
    }

    public function getDate()
    {
        return Yii::$app->formatter->asDatetime($this->date);
    }

    public function viewedCounter()
    {
        $this->viewed += 1;
        return $this->save(false);
    }

    public function getArticleComments($id, $pageSize = 5)
    {
        $query = Comment::find()->where(['status' => 1, 'article_id' => $id]);
        $count = $query->count();

        $data = PaginationSite::getPagination($query, $count, $pageSize);

        return $data;
    }
}
