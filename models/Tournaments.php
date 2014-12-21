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

class Tournaments extends ActiveRecord
{

    public static function collectionName()
    {
        return 'tournaments';
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
        return ['_id', 'title', 'prise_pool', 'max_teams', 'date', 'contribution'];
    }

} 