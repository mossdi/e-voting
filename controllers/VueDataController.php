<?php

namespace app\controllers;

use Yii;
use yii\base\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\helpers\Json;
use app\entities\Speech;
use app\entities\Rating;
use app\entities\SpeechTime;
use app\entities\Online;
use app\entities\Setting;

/**
 * Class VueDataController
 * @package app\controllers
 */
class VueDataController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'switch-now',
                    'switch-voting',
                    'switch-end',
                    'set-speech-start-time',
                    'set-voting-start-time',
                    'set-voting-end-time',
                    'set-speech-rating-summary',
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', 'moderator'],
                    ],
                ],
            ]
        ];
    }

    /**
     * @return Speech|bool
     */
    public function actionSwitchNow()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $rawBody = Json::decode(Yii::$app->request->getRawBody());

        Speech::updateAll(['now' => 0, 'voting' => 0], ['now' => 1]);

        $speechNext = Speech::findOne(['id' => $rawBody['id']]);
        $speechNext->updateAttributes(['now' => 1]);

        return $this->actionSetSpeechStartTime($speechNext->id) ? $speechNext : false;
    }

    /**
     * @return Speech|bool
     */
    public function actionSwitchVoting()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $rawBody = Json::decode(Yii::$app->request->getRawBody());

        $speechNow = Speech::findOne(['id' => $rawBody['id']]);
        $speechNow->updateAttributes(['voting' => 1]);

        return $this->actionSetVotingStartTime($speechNow->id) ? $speechNow : false;
    }

    /**
     * @return Speech|bool
     */
    public function actionSwitchEnd()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $rawBody = Json::decode(Yii::$app->request->getRawBody());

        $votingNow = Speech::findOne(['id' => $rawBody['id']]);
        $votingNow->updateAttributes(['now' => 0, 'voting' => 0]);

        return $this->actionSetVotingEndTime($votingNow->id) ? $votingNow : false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function actionSetSpeechStartTime($id)
    {
        $result = SpeechTime::findOne($id);

        $speechStart = $result ? $result : new SpeechTime();

        $speechStart->speech_id = $id;
        $speechStart->speech_start = time();

        return (bool)$speechStart->save();
    }

    /**
     * @param $id
     * @return bool
     */
    public function actionSetVotingStartTime($id)
    {
        $speechNow = SpeechTime::findOne($id);
        $speechNow->updateAttributes(['voting_start' => time()]);

        return $speechNow->voting_start != null;
    }

    /**
     * @param $id
     * @return bool
     */
    public function actionSetVotingEndTime($id)
    {
        $speechNow = SpeechTime::findOne($id);
        $speechNow->updateAttributes(['voting_end' => time()]);

        return $speechNow->voting_end != null;
    }

    /**
     * @return bool
     */
    public function actionCheckFormVisible()
    {
        $rawBody = Json::decode(Yii::$app->request->getRawBody());

        $alreadyVoted = Rating::findOne([
            'user_id'   => Yii::$app->user->id,
            'speech_id' => $rawBody['speechID']
        ]);

        return !$alreadyVoted;
    }

    /**
     * @return array
     */
    public function actionAllSpeech()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return Speech::find()
            ->where(['status' => Speech::STATUS_ACTIVE])
            ->all();
    }

    /**
     * @return array|bool
     */
    public function actionNowSpeech() //TODO: не возвращает speech_logo.image из связной таблицы
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $nowSpeech = Speech::find()
            ->select(['id', 'name', 'collective', 'member', 'voting', 'sort_order', 'speech_logo.image as image'])
            ->leftJoin('speech_logo', 'speech.id = speech_logo.speech_id')
            ->where(['now' => 1])
            ->one();

        return $nowSpeech ?: null;
    }

    /**
     * @return array|bool
     */
    public function actionCompletedSpeech()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $completedSpeech = SpeechTime::find()->all();

        return $completedSpeech ?: null;
    }

    /**
     * Set last activity
     */
    public function actionSetLastActivity()
    {
        $user = Online::findOne(Yii::$app->user->id);

        if ($user) {
            $user->updateAttributes(['last_activity' => time()]);
        } else {
            $user = new Online();

            $user->user_id = Yii::$app->user->id;
            $user->last_activity = time();
            $user->ip = Yii::$app->request->userIP;

            $user->save();
        }
    }

    /**
     * @return int|string
     */
    public function actionGetUsersOnline()
    {
        return Online::find()
            ->where(['>', 'last_activity', (time() - 60)])
            ->count();
    }

    /**
     * @return array
     * @throws \yii\db\Exception
     */
    public function actionGetUsersVoted()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $rating = Yii::$app->db
            ->createCommand('SELECT speech_id, COUNT(user_id) AS users FROM rating GROUP BY speech_id')
            ->queryAll();

        return $rating ?: null;
    }

    /**
     * @return bool|string
     */
    public function actionGetConcludingSetting()
    {
        $setting = Setting::findOne(['param' => 'speechConcluding']);

        return $setting ? $setting->value : false;
    }

    /**
     * @return bool|string
     */
    public function actionGetCriterionShow()
    {
        $setting = Setting::findOne(['param' => 'criterionShow']);

        return ($setting && $setting->value !== 'off') ? $setting->value : false;
    }
}
