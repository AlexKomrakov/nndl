<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\components;

use yii\authclient\OpenId;

class SteamOpenId extends OpenId
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'http://steamcommunity.com/openid';

    /**
     * @inheritdoc
     */
    public $requiredAttributes = [];

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 880,
            'popupHeight' => 520,
        ];
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'steam';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Steam';
    }
}
