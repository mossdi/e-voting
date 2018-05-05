<?php

namespace app\entities;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "speech".
 *
 * @property string $name [VARCHAR(255)]
 * @property string $collective [VARCHAR(255)]
 * @property string $member [VARCHAR(255)]
 * @property string $logo
 * @property int $id [INT(10)]
 * @property int $now [SMALLINT(5)]
 * @property int $voting [SMALLINT(5)]
 * @property int $sort_order [INT(10)]
 * @property int $status [SMALLINT(5)]
 * @property int $created_at [INT(10)]
 * @property int $updated_at [INT(10)]
 */
class Speech extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public static $statusList = [
        self::STATUS_ACTIVE  => 'Включено',
        self::STATUS_DELETED => 'Отключено',
    ];

    public $file;
    public $del_img;
    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'speech';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'collective', 'member', 'sort_order'], 'required'],
            [['name', 'collective', 'member'], 'string'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['sort_order'], 'integer'],
            [['del_img'], 'boolean'],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название работы',
            'collective' => 'Коллектив',
            'file' => 'Логотип команды',
            'del_img' => 'Удалить логотип',
            'member' => 'Участники коллектива',
            'sort_order' => 'Номер выступления',
            'status' => 'Статус',
        ];
    }

    /**
     * @return null|string
     */
    public function getLogo()
    {
        $logo = SpeechLogo::findOne([
            'speech_id' => $this->id
        ]);

        return $logo ? $logo->image : null;
    }
}
