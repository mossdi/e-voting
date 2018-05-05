<?php

/* @var $this \yii\web\View */

?>

<div class="now-speech">
    <div class="collective">
        <table>
            <tbody>
            <tr>
                <td v-if="nowSpeech.image">
                    <img :src="('/image/logo/' + nowSpeech.image)">
                </td>
                <td>
                    <span class="name">{{ nowSpeech.collective }}</span
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="theme">
        <span v-html="nowSpeech.name"></span>
    </div>
    <div class="member">
        <table class="table-responsive">
            <tbody>
            <tr>
                <td>
                    <span>{{ nowSpeech.member }}</span>
                </td>
                <td class="sort_order">
                    <span>{{ nowSpeech.sort_order }}</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
