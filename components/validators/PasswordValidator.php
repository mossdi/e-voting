<?php

namespace app\components\validators;

use yii\validators\Validator;
use app\entities\User;

class PasswordValidator extends Validator
{
    /**
     * @param \yii\base\Model $form
     * @param string $attribute
     */
    public function validateAttribute($form, $attribute)
    {
        $user = User::findByUsername(!empty($form->username) ? $form->username : null);

        if (!$user || !$user->validatePassword(!empty($form->password) ? $form->password : null)) {
            $this->addError($form, $attribute, 'Неверный пароль или телефон');
        }
    }
}
