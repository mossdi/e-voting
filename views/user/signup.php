<?php

/* @var $this \yii\web\View */
/* @var $model \app\forms\SignupForm */
/* @var $user_flag bool */
/* @var $post  */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\entities\User;

?>

<div class="site-signup">
    <div class="row">

        <div class="col-xs-12">
            <div class="row">
                <?php $form = ActiveForm::begin([
                    'id' => 'signup-form',
                    'action' => ['/user/signup'],
                    'validationUrl' => ['/user/signup-validate'],
                    'enableAjaxValidation' => true,
                    'fieldConfig' => [
                        'template' => "{label}\n{input}",
                    ],
                ]); ?>

                <?= $form->field($model, 'username', ['options' => ['class' => 'col-xs-6']])
                    ->textInput(['placeholder' => 'Логин']) ?>

                <?= $form->field($model, 'password', ['options' => ['class' => 'col-xs-6']])
                    ->textInput(['placeholder' => 'Пароль']) ?>

                <?= $form->field($model, 'role', ['options' => ['class' => 'col-xs-6']])
                    ->dropDownList(User::$roleList) ?>

                <?= $form->field($model, 'status', ['options' => ['class' => 'col-xs-6']])
                    ->dropDownList(User::$statusList) ?>
            </div>

            <hr>

            <div class="form-group">
                <?= Html::submitButton('Зарегистрировать', [
                    'class' => 'col-xs-3 btn btn-default',
                    'name' => 'signup',
                    'value' => 'register',
                    'form' => 'signup-form'
                ]); ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
