<?php

namespace app\components;

use Yii;

use app\entities\User;
use app\forms\LoginForm;

class LoginComponent
{
    /**
     * @return User|bool
     * @throws \yii\base\Exception
     */
    public function login()
    {
        $guest = (new UserComponent())->signupGuest();

        return Yii::$app->user->login(User::findByUsername($guest->username),  3600 * 24 * 30) ? $guest : false;
    }

    /**
     * @param LoginForm $form
     * @return bool
     */
    public function loginAdmin(LoginForm $form)
    {
        return Yii::$app->user->login(User::findByUsername($form->username), $form->rememberMe ? 3600 * 24 * 30 : 0);
    }
}
