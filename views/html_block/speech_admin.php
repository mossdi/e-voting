<?php

/* @var $speechList \yii\data\ActiveDataProvider */
/* @var $this \yii\web\View */
/* @var $limit int */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

try {
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $speechList,
        'layout' => '{items}',
        'columns' => [

            'sort_order',
            'name:html',
            [
                'label' => 'Статистика',
                'format' => 'html',
                'headerOptions' => [
                    'style' => 'min-width:230px;'
                ],
                'value' => function($model) {
                    return
                        '<div>Начало выступления: <strong>{{ speechStart(' . $model->id . ') }}</strong></div>' .
                        '<div>Длит-ь выступления: <strong>{{ speechInterval(' . $model->id . ') }}</strong></div>' .
                        '<div>Начало голосования: <strong>{{ votingStart(' . $model->id . ') }}</strong></div>' .
                        '<div>Длит-ь голосования: <strong>{{ votingInterval(' . $model->id . ') }}</strong></div>' .
                        '<div>Завершение: <strong>{{ speechEnd(' . $model->id . ') }}</strong></div>' .
                        '<div>Голосов: <strong>{{ usersVoted(' . $model->id . ') }}</strong></div>';
                }
            ],
            [
                'label' => 'Выступление',
                'format' => 'html',
                'value' => function($model) {
                    return '<div class="text-center"><strong>{{ speechMarker(' . $model->id . ') }}</strong></div>';
                }
            ],
            [
                'label' => 'Голосование',
                'format' => 'html',
                'value' => function($model) {
                    return '<div class="text-center"><strong>{{ votingMarker(' . $model->id . ') }}</strong></div>';
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действие',
                'template' => '{speechBegin} {votingStart} {speechEnd}',
                'buttons' => [
                    'speechBegin' => function($url, $model, $key) {
                        return Html::button('Начать', [
                            'v-on:click' => 'switchNow(' . $model->id . ')',
                            'v-if'       => 'beginButton(' . $model->id . ')',
                            ':disabled'  => 'beginButtonDisabled()',
                            'class'      => 'btn btn-default col-xs-12 col-margin-bottom-10',
                        ]);
                    },
                    'votingStart' => function($url, $model, $key) {
                        return Html::button('Голосование', [
                            'v-on:click' => 'switchVoting(' . $model->id . ')',
                            'v-if'       => 'votingButton(' . $model->id . ')',
                            'class'      => 'btn btn-info col-xs-12 col-margin-bottom-10',
                        ]);
                    },
                    'speechEnd' => function($url, $model, $key) {
                        return Html::button('Завершить', [
                            'v-on:click' => 'switchEnd(' . $model->id . ')',
                            'v-if'       => 'endButton(' . $model->id . ')',
                            'class'      => 'btn btn-danger col-xs-12 col-margin-bottom-10',
                        ]);
                    },
                ]
            ]
        ],
    ]);
    Pjax::end();
} catch (Exception $e) {
    echo 'Выброшено исключение: ', $e->getMessage(), "\n";
}
