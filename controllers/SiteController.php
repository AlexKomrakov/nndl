<?php

namespace app\controllers;

use app\components\SteamAPI;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{

    public $layout = 'main.twig';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'view' => 'error.twig',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        $attributes['id'] = array_reverse( explode("/", $attributes['id']) )[0];
        $user = User::findBySteamId($attributes['id']);
        if (!$user) {
            $steam_api = new SteamAPI( Yii::$app->params['steamWebAPI'] );
            $summaries = $steam_api->getPlayerSummaries( $attributes['id'] );
            User::addUser($summaries[0]);
            $user = User::findBySteamId($attributes['id']);
        }
        Yii::$app->user->login($user, 3600*24*30);
    }

    public function actionIndex()
    {
        return $this->render('index.twig');
    }


    public function actionLogin()
    {
        return $this->redirect( Url::toRoute([ '/site/auth', 'authclient' => 'steam' ]) );
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
