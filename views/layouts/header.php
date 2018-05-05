<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

?>

<header class="main-header">
    <nav class="navbar navbar-static-top" role="navigation">
        <?php if (Yii::$app->user->can('admin') || Yii::$app->user->can('moderator')): ?>
            <div class="pull-left col-admin-menu">
                <?= $this->render(
                    '/element/menu'
                ) ?>
            </div>
            <?php if (Yii::$app->user->identity): ?>
                <div class="pull-right text-right col-padding-15-45">
                    <?= Yii::$app->user->identity->username; ?>
                    <?= Html::a('Выйти', ['/user/logout'],
                        ['data-method' => 'post']
                    ) ?>
                </div>
            <?php endif; ?>
            <div class="pull-right text-right col-padding-15-25">
                <strong>Администрирование</strong>
            </div>
            <div class="pull-right text-right col-padding-15-25">
                <span class="users-online">Online:</span> <strong id="countOnline"></strong>
            </div>
        <?php else: ?>
            <div class="pull-left text-left">
                <?= Html::a( Html::img('@web/image/logo/moscow_gerb.png', ['class' => 'img-responsive']),
                    Yii::$app->homeUrl, ['class' => 'logo']
                ) ?>
            </div>
            <div class="pull-left text-left logo-description">
                <strong>ПРЕМИЯ ГОРОДА МОСКВЫ</strong><br>
                <strong>в области медицины</strong>
            </div>
            <div class="pull-right text-right now-title">
                <strong id="nowTitle"></strong>
            </div>
        <?php endif; ?>
    </nav>
</header>
