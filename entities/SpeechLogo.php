<?php

namespace app\entities;

/**
 * This is the model class for table "speech_logo".
 *
 * @property int $speech_id
 * @property string $image
 */
class SpeechLogo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'speech_logo';
    }
}
