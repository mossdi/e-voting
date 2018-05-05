<?php

/* @var $this \yii\web\View */

use yii\helpers\Html;

$this->title = 'Системные настройки';

?>

<div class="options-page">
    <div class="container">
        <div class="row">
            <h3>Очистка таблиц</h3>
            <ul class="list-unstyled">
                <li>
                    <?= Html::a('Очистить список гостей', ['/setting/clear-all-guest'], [
                        'class' => 'btn btn-danger col-margin-bottom-10',
                        'aria-label' => 'Удалить гостей',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите сделать это?',
                            'method' => 'post',
                        ],
                    ]); ?>
                </li>
                <li>
                    <?= Html::a('Очистить таблицу рейтингов', ['/setting/clear-all-rating'], [
                        'class' => 'btn btn-danger col-margin-bottom-10',
                        'aria-label' => 'Очистить рейтинги',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите сделать это?',
                            'method' => 'post',
                        ],
                    ]); ?>
                </li>
                <li>
                    <?= Html::a('Очистить таблицу интервалов', ['/setting/clear-all-interval'], [
                        'class' => 'btn btn-danger col-margin-bottom-10',
                        'aria-label' => 'Очистить интервалы',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите сделать это?',
                            'method' => 'post',
                        ],
                    ]); ?>
                </li>
            </ul>
            <p style="color:red">Внимание! Данные удаляются безвозвратно!</p>
        </div>
    </div>
</div>
