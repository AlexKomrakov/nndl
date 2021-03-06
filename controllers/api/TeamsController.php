<?php

namespace app\controllers\api;

use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 10.12.2014
 * Time: 21:46
 */

class TeamsController extends ActiveController
{

    public $modelClass = 'app\models\Teams';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;

        return $behaviors;
    }

} 