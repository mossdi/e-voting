<?php

namespace app\entities;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property int $speech_id
 * @property int $user_id
 * @property int $efficiency
 * @property int $newness
 * @property int $originality
 * @property int $reliability
 * @property int $acceptance
 */
class Rating extends \yii\db\ActiveRecord
{
    public $users;
    public $summary;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'users' => 'Количество голосов',
            'efficiency' => 'Эффективность',
            'newness' => 'Новизна',
            'originality' => 'Оригинальность',
            'reliability' => 'Надёжность',
            'acceptance' => 'Общественное признание',
            'summary' => 'Суммарный бал',
        ];
    }

    /**
     * @param $speechID
     * @param $efficiency
     * @param $newness
     * @param $originality
     * @param $reliability
     * @param $acceptance
     * @return Rating
     */
    public static function create($speechID, $efficiency, $newness, $originality, $reliability, $acceptance)
    {
        $rating = new self();

        $rating->speech_id = $speechID;
        $rating->user_id = Yii::$app->user->id;

        $rating->efficiency = $efficiency;
        $rating->newness = $newness;
        $rating->originality = $originality;
        $rating->reliability = $reliability;
        $rating->acceptance = $acceptance;

        return $rating;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpeech()
    {
        return $this->hasOne(Speech::className(), ['id' => 'speech_id']);
    }
}
