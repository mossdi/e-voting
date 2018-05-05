<?php

namespace app\entities;

/**
 * This is the model class for table "online".
 *
 * @property int $user_id
 * @property int $last_activity
 * @property string $ip
 */
class Online extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'online';
    }
}
