<?php
namespace backend\forms;

use Yii;
use yii\base\Model;
use common\models\User;

class SignupForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;
    public $email;

    public function rules()
    {
        return [
            [['password', 'email'], 'required'],
            [['username', 'password', 'email'], 'trim'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Имя пользователя занято'],
            [ 'email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с таким адресом уже есть'],
            ['email', 'email'],
            ['password', 'string', 'min' => 5, 'max' => 10],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'password_repeat' => 'Подтверждение пароля',
            'email' => 'Адрес электронной почты',
        ];
    }

    public function signup($params)
    {
        if ($this->load($params)) {
            $user = new User();
            $user->setAttributes(
                [
                    'username' => ((is_null($this->username) || empty($this->username)) ? explode('@', $this->email)[0] : $this->username),
                    'email' => $this->email,
                    'password_hash' => $user->setPassword($this->password, true)
                ],
                false
            );
            return $user->save();
        }
        return false;
    }
}
