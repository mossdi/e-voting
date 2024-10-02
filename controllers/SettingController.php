<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\entities\User;
use app\entities\Rating;
use app\entities\SpeechTime;
use app\entities\Speech;
use app\entities\Online;
use app\entities\Setting;

/**
 * Class SettingController
 * @package app\controllers
 */
class SettingController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'clear-all-guest' => ['post'],
                    'clear-all-rating' => ['post'],
                    'clear-all-interval' => ['post'],
                    'set-concluding-setting' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'clear-all-guest',
                    'clear-all-rating',
                    'clear-all-interval',
                    'set-concluding-setting',
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ]
        ];
    }

    public function actionClearAllGuest()
    {
        User::deleteAll(['role' => 'guest']);
        Online::deleteAll();

        Yii::$app->session->setFlash('success', 'Все гости удалены!');

        $this->redirect('/site/setting');
    }

    public function actionClearAllRating()
    {
        Rating::deleteAll();

        Yii::$app->session->setFlash('success', 'Рейтинги очищены!');

        $this->redirect('/site/setting');
    }

    public function actionClearAllInterval()
    {
        SpeechTime::deleteAll();
        Speech::updateAll(['now' => 0, 'voting' => 0]);

        Yii::$app->session->setFlash('success', 'Временные метки удалены!');

        $this->redirect('/site/setting');
    }

    public function actionSetConcludingSetting($value)
    {
        $setting = Setting::findOne(['param' => 'speechConcluding']);

        if ($setting) {
            $setting->updateAttributes(['value' => $value]);
            Yii::$app->session->setFlash('success', 'Настройка успешно изменена!');
        } else {
            Yii::$app->session->setFlash('success', 'Ошибка!');
        }

        $this->redirect('/site/concluding');
    }

    public function actionSetCriterionSetting($value)
    {
        $setting = Setting::findOne(['param' => 'criterionShow']);

        if ($setting) {
            $setting->updateAttributes(['value' => $value]);
            Yii::$app->session->setFlash('success', 'Настройка успешно изменена!');
        } else {
            Yii::$app->session->setFlash('success', 'Ошибка!');
        }

        $this->redirect('/site/concluding');
    }
}
