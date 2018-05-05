<?php

namespace app\components;

use Yii;
use app\forms\SignupForm;
use app\entities\User;

class UserComponent
{
    /**
     * @return User
     * @throws \yii\base\Exception
     * @throws \Exception
     */
    public function signupGuest()
    {
        $username = Yii::$app->security->generateRandomString(8) . crc32(time());
        $role = 'guest';
        $password = crc32(time());
        $status = User::STATUS_ACTIVE;

        $user = User::create(
            $username,
            $role,
            $password,
            $status
        );

        if (!$user->save()) {
            throw new \Exception('Ошибка создания пользователя');
        }

        return $user;
    }

    /**
     * @param SignupForm $form
     * @return User
     * @throws \yii\base\Exception
     * @throws \Exception
     */
    public function signup(SignupForm $form)
    {
        $user = User::create(
            $form->username,
            $form->role,
            $form->password,
            $form->status
        );

        if (!$user->save()) {
            throw new \Exception('Ошибка создания пользователя');
        }

        $this->assignRole($form->role, $user->username);

        return $user;
    }

    /**
     * @param $role
     * @param $username
     * @return mixed
     */
    public function assignRole($role, $username)
    {
        $user = User::findByUsername($username);

        $userRole = Yii::$app->authManager->getRole($role);

        try {
            return Yii::$app->authManager->assign($userRole, $user->id) ? true : false;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
