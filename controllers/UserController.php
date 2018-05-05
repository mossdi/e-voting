<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\bootstrap\ActiveForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\UserComponent;
use app\components\LoginComponent;
use app\forms\LoginForm;
use app\forms\SignupForm;

class UserController extends Controller
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
                    'logout' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['signup-form', 'signup'],
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
     * LoginGuest action.
     *
     * @return Response|string
     * @throws \yii\base\Exception
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'main_login';

        if (Yii::$app->request->post()) {
            if ((new LoginComponent())->login()) {
                $this->refresh();
            };
        }

        return $this->render('login');
    }

    /**
     * LoginAdmin action.
     *
     * @return Response|string
     */
    public function actionLoginAdmin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'main_login';

        $form = new LoginForm();
        $form->scenario = LoginForm::SCENARIO_ADMIN;

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            if ((new LoginComponent())->loginAdmin($form)) {
                $this->refresh();
            };
        }

        $form->password = '';

        return $this->render('login_admin', [
            'model' => $form,
        ]);
    }

    /**
     * Logout action.
     *
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * SignUp form
     *
     * @return array|string
     */
    public function actionSignupForm()
    {
        if (!Yii::$app->user->can('admin')) {
            $this->redirect('/site/index');
        }

        $form = new SignupForm();

        return $this->renderAjax('signup', [
            'model' => $form,
        ]);
    }

    /**
     * SignUp form validate
     *
     * @param string $scenario
     * @return array|string
     */
    public function actionSignupValidate($scenario = 'create')
    {
        $form = new SignupForm();

        if ($scenario == 'create') {
            $form->scenario = SignupForm::SCENARIO_CREATE;
        }

        if (Yii::$app->request->isAjax && $form->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($form);
        }
    }

    /**
     * SignUp user
     *
     * @throws \yii\base\Exception
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->can('admin')) {
            $this->redirect('/site/index');
        }

        $form = new SignupForm();
        $form->scenario = SignupForm::SCENARIO_CREATE;

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            if ((new UserComponent())->signup($form)) {
                Yii::$app->session->setFlash('success', 'Пользователь успешно зарегистрирован в системе.');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка. Пользователь не зарегистрирован. Обратитесь к администратору системы.');
            };

            $this->redirect(
                '/site/index'
            );
        }
    }
}
