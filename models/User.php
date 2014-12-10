<?php

namespace app\models;

use Yii;
use yii\mongodb\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    public static function collectionName()
    {
        return 'user';
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return ['_id', 'steamid', 'personaname', 'profileurl', 'avatarfull'];
    }

    public static function addUser ($summaries)
    {
        $user = new User;
        $user->steamid     = $summaries['steamid'];
        $user->personaname = $summaries['personaname'];
        $user->profileurl  = $summaries['profileurl'];
        $user->avatarfull  = $summaries['avatarfull'];
        $user->save();
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getAuthKey()
    {
        return $this->steamid;
    }

    public function validateAuthKey($authKey)
    {
        return $this->steamid === $authKey;
    }

    public static function findBySteamId($steamid)
    {
        return static::findOne(['steamid' => $steamid]);
    }

    public static function hasTeam()
    {
        return !empty(Teams::findTeamBySteamId( Yii::$app->user->identity->steamid ));
    }

    public static function isAdmin()
    {
        return (Yii::$app->user->identity->steamid == Yii::$app->params['admin_id']);
    }

}
