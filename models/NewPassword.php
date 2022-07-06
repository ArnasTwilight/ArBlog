<?php

namespace app\models;

use Yii;
use yii\base\Model;

class NewPassword extends Model
{
    public $oldPassword;
    public $newPassword;
    public $repeatPassword;

    private $userPassword;

    public function rules()
    {
        return [
            [['oldPassword', 'newPassword', 'repeatPassword'], 'required'],
            [['newPassword', 'repeatPassword'], 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            [['oldPassword'], 'validatePasswordOld'],
            [['newPassword'], 'validatePasswordMatch'],
        ];
    }

    public function validatePasswordOld($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            if (!$this->matchOldPassword())
            {
                $this->addError($attribute, 'Invalid password');
            }
        }
    }

    public function validatePasswordMatch($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            if (!$this->preparePassword())
            {
                $this->addError($attribute, 'Passwords do not match');
            }
        }
    }

    public function setNewPassword($user)
    {
        $this->userPassword = $user->password;

        if ($this->validate())
        {
            $user->password = $this->newPassword;
            return $user->save(false);
        }
        return false;
    }

    private function matchOldPassword ()
    {
        return Yii::$app->security->validatePassword($this->oldPassword, $this->userPassword) ? true : false;
    }

    private function preparePassword ()
    {
        if ($this->matchPasswords())
        {
            return $this->hashPassword();
        }
        return false;
    }

    private function matchPasswords ()
    {
        return $this->newPassword === $this->repeatPassword ? true : false;
    }

    private function hashPassword ()
    {
       return $this->newPassword = Yii::$app->security->generatePasswordHash($this->newPassword);
    }

}
