<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 13.10.2014
 * Time: 21:48
 */

namespace app\components;


use Yii;

class SteamAPI {

    private $api_key;

    public function __construct ($api_key)
    {
        $this->api_key = $api_key;
    }

    /**
     * Array (
     * [steamid] => 76561198032255024
     * [communityvisibilitystate] => 3
     * [profilestate] => 1
     * [personaname] => Shark
     * [lastlogoff] => 1413144605
     * [profileurl] => http://steamcommunity.com/profiles/76561198032255024/
     * [avatar] => http://media.steampowered.com/steamcommunity/public/images/avatars/89/89c6e7f8f24bd9135fba8180a66583bdaaf5deed.jpg
     * [avatarmedium] => http://media.steampowered.com/steamcommunity/public/images/avatars/89/89c6e7f8f24bd9135fba8180a66583bdaaf5deed_medium.jpg
     * [avatarfull] => http://media.steampowered.com/steamcommunity/public/images/avatars/89/89c6e7f8f24bd9135fba8180a66583bdaaf5deed_full.jpg
     * [personastate] => 0
     * [realname] => РђР»РµРєСЃРµР№
     * [primaryclanid] => 103582791434277245
     * [timecreated] => 1287759573
     * [personastateflags] => 0
     * [loccountrycode] => RU
     * [locstatecode] => 51
     * [loccityid] => 41617
     * )
     *
     * @param $player_id
     * @return array | null
     */
    public function getPlayerSummaries($player_id)
    {
        $key    = Yii::$app->cache->buildKey(['getPlayerSummaries', $player_id]);
        $result = Yii::$app->cache->get($key);
        if ($result === false) {
            $api_key = $this->api_key;
            if (is_array($player_id)) {
                $player_id = implode(",", $player_id);
            }
            $link = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key={$api_key}&steamids={$player_id}";
            $response = json_decode(file_get_contents($link), true);

            if (isset($response['response']['players'])) {
                Yii::$app->cache->set($key, $response['response']['players'], 24*60*60);
                $result = $response['response']['players'];
            } else {
                $result = null;
            }
        }

        return $result;
    }

    /**
     * Array ( Array (
     * [steamid] => 76561197982688306
     * [relationship] => friend
     * [friend_since] => 1357669102
     * ) )
     *
     * @param string $player_id
     * @return array | null
     */
    public function getFriendList($player_id)
    {
        $key    = Yii::$app->cache->buildKey(['getFriendList', $player_id]);
        $result = Yii::$app->cache->get($key);
        if ($result === false) {
            $api_key = $this->api_key;
            $link = "http://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key={$api_key}&steamid={$player_id}&relationship=friend";
            $response = json_decode(file_get_contents($link), true);
            if (isset($response['friendslist']['friends'])) {
                $result = $response['friendslist']['friends'];
                Yii::$app->cache->set($key, $result, 10*60);
            } else {
                $result = null;
            }
        }

        return $result;
    }

    public function extendFriendList(array $list)
    {
        $result = [];
        $chunks = [];
        foreach ($list as $key => $element) {
            $list[$key] = $element['steamid'];
        }
        for ($i = 0; $i < count($list); $i += 100) {
            $chunks[] = array_splice($list, $i, 100);
        }
        foreach ($chunks as $chunk) {
            $result = array_merge( $this->getPlayerSummaries($chunk), $result );
        }

        return $result;
    }

    /**
     * @param string $match_id
     * @return array
     */
    public function getMatchDetails($match_id)
    {
        $api_key = $this->api_key;
        $link = "http://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/v0001/?key={$api_key}&match_id={$match_id}";
        $response = json_decode(file_get_contents($link), true);

        return $response;
    }

} 