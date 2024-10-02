<?php

/* @var $this yii\web\View */
/* @var $speechStatistic \yii\data\ActiveDataProvider */
/* @var $speechList \yii\data\ActiveDataProvider */

$this->title = 'Voting Dashboard';

?>

<?php if (Yii::$app->user->can('admin') || Yii::$app->user->can('moderator')):
    echo $this->render('/site/admin', [
        'speechStatistic' => $speechStatistic,
        'speechList' => $speechList,
    ]);
else:
    echo $this->render('/site/guest', [
        'speechList' => $speechList,
    ]);
endif; ?>
