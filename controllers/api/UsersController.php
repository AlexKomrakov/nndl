<?php

namespace app\controllers\api;

use app\components\SteamAPI;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 10.12.2014
 * Time: 21:46
 */

class UsersController extends ActiveController
{

    public $modelClass = 'app\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;

        return $behaviors;
    }

    public function actionFriends($id)
    {
        $steam_api = new SteamAPI( Yii::$app->params['steamWebAPI'] );
        $friends = $steam_api->getFriendList( $id );
        $friends = $steam_api->extendFriendList( $friends );

        return $friends;
    }

} 