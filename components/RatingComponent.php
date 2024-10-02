<?php

namespace app\components;

use Yii;
use app\forms\CriterionForm;
use app\entities\Rating;
use app\entities\Speech;

class RatingComponent
{
    /**
     * @param CriterionForm $form
     * @return array
     * @throws \Exception
     */
    public function addRating(CriterionForm $form)
    {
        $nowSpeech = Speech::findOne([
            'now'    => 1,
            'voting' => 1
        ]);

        if (!$nowSpeech) {
            return [
                'status'  => 'error',
                'message' => 'Нет открытых голосований! Возможно Вы не успели!'
            ];
        }

        $voted = Rating::findOne([
            'user_id'   => Yii::$app->user->id,
            'speech_id' => $nowSpeech->id
        ]);

        if ($voted) {
            return [
                'status'  => 'error',
                'message' => 'Вы уже голосовали за текущее выступление!'
            ];
        }

        $rating = Rating::create(
            $nowSpeech->id,
            $form->efficiency,
            $form->newness,
            $form->originality,
            $form->reliability,
            $form->acceptance
        );

        return $rating->save()
            ? [
                'status'  => 'success',
                'message' => 'Ваши оценки учтены! Спасибо!'
            ]
            : [
                'status'  => 'error',
                'message' => 'Ошибка. Голоса не учтены! Попробуйте ещё раз!'
            ];
    }
}
