<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 21.10.2014
 * Time: 20:23
 */

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class TournamentsController extends Controller {

    public $layout = 'main.twig';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => isset(Yii::$app->user->identity) && Yii::$app->user->identity->isAdmin(),
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false,
                    ],
                ],
            ]
        ];
    }

    public function actionCreate()
    {
        return $this->render('create.twig');
    }

} 