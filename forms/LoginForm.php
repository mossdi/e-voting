<?php
namespace app\forms;

use yii\base\Model;
use app\components\validators\PasswordValidator;

/**
 * Login form
 */
class LoginForm extends Model
{
    const SCENARIO_ADMIN = 'admin';

    public $username;
    public $password;
    public $rememberMe = true;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'required', 'message' => 'Введите логин', 'on' => self::SCENARIO_ADMIN],
            ['password', 'required', 'message' => 'Введите пароль', 'on' => self::SCENARIO_ADMIN],
            ['password', PasswordValidator::className(), 'on' => self::SCENARIO_ADMIN],
            ['rememberMe', 'boolean'],
        ];
    }
}
