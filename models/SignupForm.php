<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $login;
    public $email;
    public $password;
    public $passwordRepeat;

    public function rules()
    {
        return [
            [['login', 'email', 'password', 'passwordRepeat'], 'required'],
            [['login'], 'string'],
            [['login'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'login'],
            ['login', 'string', 'min' => 2, 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],
            ['email', 'string', 'max' => 255],
            [['password'], 'validatePasswordMatch'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['passwordRepeat', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    public function validatePasswordMatch($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->preparePassword())
            {
                $this->addError($attribute, 'Passwords do not match');
            }
        }
    }

    public function signup()
    {
        if($this->validate())
        {
            $user = new User();

            $user->attributes = $this->attributes;

            return $user->create();
        }
    }

    private function preparePassword()
    {
        if ($this->comparePassword()) {
            return $this->hashPassword();
        }
        return false;
    }

    private function comparePassword()
    {
        return $this->password === $this->passwordRepeat ? true : false;
    }

    private function hashPassword()
    {
        return $this->password = Yii::$app->security->generatePasswordHash($this->password);
    }
}