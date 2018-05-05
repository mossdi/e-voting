<?php

namespace app\forms;

use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    const SCENARIO_CREATE = 'create';

    public $id;
    public $username;
    public $role;
    public $password;
    public $status;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'trim'],
            [['role', 'username', 'status', 'password'], 'string',],
            [['role', 'username', 'status', 'password'], 'required', 'on' => self::SCENARIO_CREATE],
            ['username', 'unique', 'targetClass' => 'app\entities\User', 'message' => 'Такой логин уже зарегистрирован', 'on' => self::SCENARIO_CREATE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'role' => 'Роль',
            'status' => 'Статус',
        ];
    }
}
