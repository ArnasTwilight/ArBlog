<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $login
 * @property string|null $password
 * @property string|null $image
 * @property int|null $isAdmin
 * @property string|null $about
 *
 * @property Comment[] $comments
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isAdmin'], 'integer'],
            [['about'], 'string', 'max' => 255],
            [['name', 'email', 'login', 'password', 'image'], 'string', 'max' => 255],
            [['name', 'login',], 'string', 'min' => 2, 'max' => 255],
            ['email', 'unique', 'message' => 'This email address has already been taken.'],
            ['login', 'unique', 'message' => 'This login has already been taken.'],
            [['name'], 'string', 'max' => 125],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'login' => 'Login',
            'password' => 'Password',
            'image' => 'Image',
            'isAdmin' => 'Is Admin',
            'about' => 'About',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    public static function findBylogin($login)
    {
        return User::find()->where(['login' => $login])->one();
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function create()
    {
        return $this->save(false);
    }

    public function getImage()
    {
        return ($this->image) ? '/uploads/' . Yii::$app->params['user.dirImage'] . '/' . $this->id . '/' . $this->image : Yii::$app->params['user.NoImage'];
    }

    public function saveImage($filename)
    {
        $this->image = $filename;
        return $this->save(false);
    }
}

