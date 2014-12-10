<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 09.10.14
 * Time: 23:38
 */

namespace app\commands;

use yii\console\Controller;

class BracketController extends Controller {

    public function actionIndex()
    {
//        $url = "http://nndl/index.php?r=site%2Fauth&authclient=steam&openid.ns=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0&openid.mode=id_res&openid.op_endpoint=https%3A%2F%2Fsteamcommunity.com%2Fopenid%2Flogin&openid.claimed_id=http%3A%2F%2Fsteamcommunity.com%2Fopenid%2Fid%2F76561198032255024&openid.identity=http%3A%2F%2Fsteamcommunity.com%2Fopenid%2Fid%2F76561198032255024&openid.return_to=http%3A%2F%2Fnndl%2Findex.php%3Fr%3Dsite%252Fauth%26authclient%3Dsteam&openid.response_nonce=2014-10-12T10%3A45%3A12ZObalu%2Bpei%2FOEycgNe17aY60p3Ck%3D&openid.assoc_handle=1234567890&openid.signed=signed%2Cop_endpoint%2Cclaimed_id%2Cidentity%2Creturn_to%2Cresponse_nonce%2Cassoc_handle&openid.sig=BH2EokMTILEBvxwE3rFz5%2BPVZJY%3D";
//        print_r(urldecode($url));
//        $teams = $this->generateArray(9);
//        print_r( count($teams) );
//        print_r($this->generateBracket($teams));
    }

    private function generateArray($size){
        $array = [];
        for ($i = 0; $i < $size; $i++) {
            $array[] = $i;
        }
        return $array;
    }

    private function generateBracket($teams){
        $count = count($teams);
        $bracket = [];
        do {
            $matches = [];
            $matches_count = count( $bracket[ count($bracket)-1 ] )*2;
            $matches_count = ($matches_count == 0) ? 1 : $matches_count;
            for ($i = 0; $i < $matches_count; $i++) {
                print_r(count( $bracket[ count($bracket)-1 ] )*2);
                $matches[] = [
                    'team1' => "",
                    'team2' => ""
                ];
            }
            $bracket[] = $matches;
        } while ($count > count( $bracket[ count($bracket)-1 ] ));
        return $bracket;
    }

} 