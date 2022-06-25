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
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],
            [['password'], 'validatePasswordMatch'],
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