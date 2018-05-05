<?php

/* @var $criterionTop \yii\data\ActiveDataProvider */
/* @var $criterion string */
/* @var $this \yii\web\View */

use yii\grid\GridView;

try {
    echo GridView::widget([
        'dataProvider' => $criterionTop,
        'layout' => '{items}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'speech.collective:html',
            'speech.name:html',
            [
                'attribute' => $criterion,
                'label' => 'Количество балов'
            ],
        ],
    ]);
} catch (Exception $e) {
    echo 'Выброшено исключение: ', $e->getMessage(), "\n";
}
