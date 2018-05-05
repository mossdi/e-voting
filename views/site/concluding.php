<?php

/* @var $this \yii\web\View */

use yii\helpers\Html;

$this->title = 'Итоги голосования';

$criterion = [
    'efficiency'  => 'ЭФФЕКТИВНОСТЬ',
    'newness'     => 'НОВИЗНА',
    'originality' => 'ОРИГИНАЛЬНОСТЬ',
    'reliability' => 'НАДЁЖНОСТЬ',
    'acceptance'  => 'ОБЩЕСТВЕННОЕ ПРИЗНАНИЕ',
]; ?>

<div class="concluding-page">
    <div class="container">
        <div class="row">
            <h3>Режим награждения победителей - <?= (!empty(Yii::$app->setting->get('speechConcluding')) && Yii::$app->setting->get('speechConcluding')) ? 'Включен' : 'Отключен' ?></h3>
            <ul class="list-unstyled">
                <li>
                    <?= Html::a('Включить', ['/setting/set-concluding-setting?value=1'], [
                        'class' => 'btn btn-primary col-margin-bottom-10',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите сделать это?',
                            'method' => 'post',
                        ],
                    ]); ?>
                </li>
                <li>
                    <?= Html::a('Отключить', ['/setting/set-concluding-setting?value=0'], [
                        'class' => 'btn btn-danger col-margin-bottom-10',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите сделать это?',
                            'method' => 'post',
                        ],
                    ]); ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h3>Топ критериев - <?= (!empty(Yii::$app->setting->get('criterionShow')) && Yii::$app->setting->get('criterionShow') !== 'off') ? $criterion[Yii::$app->setting->get('criterionShow')] : 'Отключен' ?></h3>
            <ul class="list-unstyled">
                <li>
                    <?= Html::a('Эффективность', ['/setting/set-criterion-setting?value=efficiency'], [
                        'class' => 'btn btn-info col-margin-bottom-10',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите сделать это?',
                            'method' => 'post',
                        ],
                    ]); ?>
                </li>
                <li>
                    <?= Html::a('Новизна', ['/setting/set-criterion-setting?value=newness'], [
                        'class' => 'btn btn-info col-margin-bottom-10',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите сделать это?',
                            'method' => 'post',
                        ],
                    ]); ?>
                </li>
                <li>
                    <?= Html::a('Оригинальность', ['/setting/set-criterion-setting?value=originality'], [
                        'class' => 'btn btn-info col-margin-bottom-10',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите сделать это?',
                            'method' => 'post',
                        ],
                    ]); ?>
                </li>
                <li>
                    <?= Html::a('Надёжность', ['/setting/set-criterion-setting?value=reliability'], [
                        'class' => 'btn btn-info col-margin-bottom-10',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите сделать это?',
                            'method' => 'post',
                        ],
                    ]); ?>
                </li>
                <li>
                    <?= Html::a('Общественное признание', ['/setting/set-criterion-setting?value=acceptance'], [
                        'class' => 'btn btn-info col-margin-bottom-10',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите сделать это?',
                            'method' => 'post',
                        ],
                    ]); ?>
                </li>
                <li>
                    <?= Html::a(' Выключить', ['/setting/set-criterion-setting?value=off'], [
                        'class' => 'btn btn-danger col-margin-bottom-10',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите сделать это?',
                            'method' => 'post',
                        ],
                    ]); ?>
                </li>
            </ul>
        </div>
    </div>
</div>
