<?php

namespace app\controllers;

use Yii;
use app\entities\Speech;
use app\entities\SpeechSearch;
use app\entities\SpeechLogo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use app\components\UploadComponent;

/**
 * SpeechController implements the CRUD actions for Speech model.
 */
class SpeechController extends Controller
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
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete'],
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
     * Lists all Speech models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpeechSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Speech model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Speech model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \Exception
     */
    public function actionCreate()
    {
        $model = new Speech();

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save()) {
                if ($file && $file->tempName) {
                    (new UploadComponent())->uploadSpeechLogo($file, $model);
                }

                Yii::$app->session->setFlash('success', 'Выступление успешно зарегистрировано в системе.');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка создания выступления.');
            }

            return $this->redirect('/speech/index');
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Speech model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $current_image = $model->logo;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->del_img) {
                if (file_exists(Yii::getAlias('@webroot/image/logo/' . $current_image))) {
                    unlink(Yii::getAlias('@webroot/image/logo/' . $current_image));
                    SpeechLogo::deleteAll(['speech_id' => $model->id]);
                }
            }

            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save()) {
                if ($file && $file->tempName) {
                    (new UploadComponent())->uploadSpeechLogo($file, $model);
                }

                Yii::$app->session->setFlash('success', 'Выступление успешно обновлено.');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка обновления выступления.');
            }
            return $this->redirect('/speech/index');
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Speech model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Speech model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Speech the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Speech::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
