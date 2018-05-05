<?php

namespace app\forms;

use yii\base\Model;

/**
 * Login form
 */
class CriterionForm extends Model
{
    public $efficiency;
    public $newness;
    public $originality;
    public $reliability;
    public $acceptance;

    public $description = [
        'efficiency'  => '<strong>Эффективность</strong> выполненной работы - соотношение между достигнутым результатом и использованными ресурсами',
        'newness'     => '<strong>Новизна</strong> выполненной работы - установленное, достигнутое впервые',
        'originality' => '<strong>Оригинальность</strong> - степень своеобразия, нестандартности в достижении полученного результата',
        'reliability' => '<strong>Надёжность</strong> - способность сохранять во времени в установленных пределах значения всех функциональных параметров',
        'acceptance'  => '<strong>Общественное признание</strong> - известность, популярность выполненной работы',
    ];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['efficiency', 'newness', 'originality', 'reliability', 'acceptance'], 'required'],
            [['efficiency', 'newness', 'originality', 'reliability', 'acceptance'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rating' => 'Рейтинг'
        ];
    }
}
