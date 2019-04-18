<?php

/* @var $this \yii\web\View */
/* @var $speechList \yii\data\ActiveDataProvider */

app\assets\VueGuestAsset::register($this);

?>

<div id="appGuest">
    <template v-if="speechConcluding">
        <?= $this->render('/html_block/speech_concluding') ?>
    </template>
    <template v-else-if="nowSpeech">
        <?= $this->render('/html_block/speech_now') ?>
    </template>
    <template v-else>
        <?= $this->render('/html_block/speech_list', ['speechList' => $speechList]) ?>
    </template>
</div>