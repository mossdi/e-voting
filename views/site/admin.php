<?php

/* @var $this \yii\web\View */
/* @var $speechStatistic \yii\data\ActiveDataProvider */
/* @var $speechList \yii\data\ActiveDataProvider */

app\assets\VueAdminAsset::register($this);

use yii\bootstrap\Tabs;

?>

<div id="appAdmin">
    <?php try {
        echo Tabs::widget([
            'items' => [
                [
                    'label'   => 'Список',
                    'content' => $this->render('/html_block/speech_admin', [
                        'speechList' => $speechList,
                    ]),
                    'active'  => true,
                    'options' => [
                        'class' => 'fade in'
                    ],
                ],
                [
                    'label'   => 'Рейтинг в разрезе',
                    'content' => $this->render('/html_block/statistic', [
                        'speechStatistic' => $speechStatistic,
                    ]),
                    'options' => [
                        'class' => 'fade'
                    ],
                ],
            ]
        ]);
    } catch (Exception $e) {
        $e->getMessage();
    } ?>
</div>
