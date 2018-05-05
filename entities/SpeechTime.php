<?php

namespace app\entities;

/**
 * This is the model class for table "speech_time".
 *
 * @property int $speech_id
 * @property int $speech_start
 * @property int $voting_start
 * @property int $voting_end
 */
class SpeechTime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'speech_time';
    }
}
