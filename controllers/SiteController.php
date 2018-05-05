<?php

namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use app\entities\Speech;
use app\entities\Rating;

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['setting'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $speechList = new ActiveDataProvider([
            'query' => Speech::find()
                ->where(['status' => 10])
                ->orderBy(['sort_order' => SORT_ASC]),
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => false,
        ]);

        $speechStatistic = new ActiveDataProvider([
            'query' => Rating::find()
                ->with(['speech'])
                ->select([
                    'speech_id',
                    'COUNT(user_id) AS users',
                    'SUM(efficiency) AS efficiency',
                    'SUM(newness) AS newness',
                    'SUM(originality) AS originality',
                    'SUM(reliability) AS reliability',
                    'SUM(acceptance) AS acceptance',
                    '(SUM(efficiency) + SUM(newness) + SUM(originality) + SUM(reliability) + SUM(acceptance)) as summary',
                ])
                ->groupBy(['speech_id'])
                ->orderBy(['summary' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => false,
        ]);

        return $this->render('index', [
            'speechList' => $speechList,
            'speechStatistic' => $speechStatistic,
        ]);
    }

    /**
     * Displays system options page.
     *
     * @return string
     */
    public function actionSetting()
    {
        return $this->render('setting');
    }

    /**
     * Displays system options page.
     *
     * @return string
     */
    public function actionConcluding()
    {
        return $this->render('concluding');
    }
}
