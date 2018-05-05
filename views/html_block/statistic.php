<?php

/* @var $speechStatistic \yii\data\ActiveDataProvider */
/* @var $this \yii\web\View */
/* @var $limit int */

use yii\grid\GridView;
use yii\widgets\Pjax;

try {
    Pjax::begin(['id' => 'statistic']);
    echo GridView::widget([
        'dataProvider' => $speechStatistic,
        'layout' => '{items}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'speech.sort_order',
            'speech.collective',
            [
                'attribute' => 'speech.name',
                'format' => 'html',
            ],
            'value' => 'users',
            [
                'label' => ' Суммарный балл',
                'format' => 'html',
                'value' => function($model) {
                    return '<strong>' . $model->summary . '</strong>';
                },
            ],
            'efficiency',
            'newness',
            'originality',
            'reliability',
            'acceptance',
        ],
    ]);
    Pjax::end();
} catch (Exception $e) {
    echo 'Выброшено исключение: ', $e->getMessage(), "\n";
}
