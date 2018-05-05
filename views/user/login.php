<?php

/* @var $this \yii\web\View */
/* @var $model \app\forms\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';

?>

<div class="moscow-logo hidden-xs">
    <?= Html::img('@web/image/logo/moscow.png', ['class' => 'image img-responsive']) ?>
</div>
<div class="login-box">
    <div class="login-box-body">
        <p class="login-box-msg"><?= Html::decode('Пожалуйста авторизируйтесь для начала сессии') ?></p>
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
        <div class="row">
            <div class="col-xs-12">
                <?= Html::submitButton('Войти', [
                    'class' => 'btn btn-default btn-block btn-flat',
                    'name' => 'login-button'
                ]) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<div class="about hidden-xs">
    <div class="title">
        <span style="font-size:70px">ПРЕМИЯ</span><br>ГОРОДА МОСКВЫ<br>В ОБЛАСТИ МЕДИЦИНЫ
    </div>
    <div class="department">
        <span>ДЕПАРТАМЕНТА ЗДРАВООХРАНЕНИЯ<br> ГОРОДА МОСКВЫ</span>
    </div>
</div>
<div class="power">
    <div class="col-xs-12 support-logo hidden-xs">
        <div class="pull-left">
            <?= Html::img('@web/image/logo/department_moscow.png', [
                'class' => 'image img-responsive',
                'style' => 'margin-right: 15px;'
            ]) ?>
        </div>
        <div class="pull-left">
            <?= Html::img('@web/image/logo/nii_ozmm.png', [
                'class' => 'image img-responsive'
            ]) ?>
        </div>
    </div>
    <div class="col-xs-12">
        <hr>
    </div>
    <div class="col-xs-12 location-logo hidden-xs" style="display:none;">
        <div class="pull-left">
            <p style="color:#ffffff;">Мероприятие проходит на территории</p>
            <?php Html::img('@web/image/logo/botkinskaya_bolnitsa.png', [
                'class' => 'image img-responsive'
            ]) ?>
        </div>
    </div>
</div>
