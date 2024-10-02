<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\forms\CriterionForm;
use app\entities\Rating;
use app\components\RatingComponent;
use yii\data\ActiveDataProvider;

class RatingController extends Controller
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
                    'add-rating' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionCriterionForm()
    {
        $form = new CriterionForm();

        return $this->renderAjax('/element/criterion_form', [
            'model' => $form,
        ]);
    }

    /**
     * @return array
     */
    public function actionCriterionFormValidate()
    {
        $form = new CriterionForm();

        if (Yii::$app->request->isAjax && $form->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($form);
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function actionAddRating()
    {
        $form = new CriterionForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $result = (new RatingComponent())->addRating($form);

            Yii::$app->session->setFlash($result['status'], $result['message']);

            $this->redirect('/site/index');
        }
    }

    /**
     * @return string
     */
    public function actionCriterionTop()
    {
        $criterion = Yii::$app->setting->get('criterionShow');

        $criterionTop = new ActiveDataProvider([
            'query' => Rating::find()
                ->with(['speech'])
                ->select([
                    'speech_id',
                    'SUM(' . $criterion . ') as ' . $criterion
                ])
                ->orderBy([$criterion => SORT_DESC])
                ->groupBy(['speech_id'])
                ->limit(10),
            'pagination' => false,
            'sort' => false,
        ]);

        return $this->renderAjax('/element/criterion_top', [
            'criterionTop' => $criterionTop,
            'criterion' => $criterion,
        ]);
    }
}
