<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 18.10.2014
 * Time: 22:11
 */

namespace app\models;


use Yii;
use yii\mongodb\ActiveRecord;

class Teams extends ActiveRecord
{

    public static function collectionName()
    {
        return 'teams';
    }

    public function scenarios()
    {
        return array(
            'default' => $this->attributes(),
        );
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return ['_id', 'title', 'players', 'reserve', 'managers'];
    }

    public static function saveTeamFromForm ($data)
    {
        if (empty($data)) {
            return false;
        }
        $model = new self;
        $model->load($data);

        return $model->save();
    }

    public static function findTeamBySteamId($steamid)
    {
        return self::find()->asArray()->where(['reserve' => $steamid])->orWhere(['managers' => $steamid])->orWhere(['players' => $steamid])->one();
    }

    public static function deleteBySteamId($steamid)
    {
        return self::deleteAll([ '$or' => [['reserve' => $steamid], ['managers' => $steamid], ['players' => $steamid] ] ]);
    }

} 