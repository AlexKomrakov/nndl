<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 17.10.2014
 * Time: 22:39
 */

namespace app\controllers;

use Yii;
use app\models\Teams;
use yii\filters\AccessControl;
use yii\web\Controller;

class TeamsController extends Controller {

    public $layout = 'main.twig';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['delete'],
                        'allow' => isset(Yii::$app->user->identity) && Yii::$app->user->identity->hasTeam(),
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => isset(Yii::$app->user->identity) ? !Yii::$app->user->identity->hasTeam() : true,
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false,
                    ],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $team = Teams::findTeamBySteamId( Yii::$app->user->identity->steamid );
        return $this->render('index.twig', [
            'team' => $team
        ]);
    }

    public function actionCreate()
    {
        if ( Teams::saveTeamFromForm(Yii::$app->request->post()) ) {
            return $this->actionIndex();
        } else {
            return $this->render('create.twig');
        }
    }

    public function actionDelete()
    {
        Teams::deleteBySteamId( Yii::$app->user->identity->steamid );
        return $this->actionIndex();
    }

} 