<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\widgets\Utils;
use app\widgets\AppConst;
use yii\curl;

class AppController extends Controller
{
    /**
     * app config
     * @return string
     */
    public function actionConfig() {
		$ret = array();
		$ret = array_merge($ret, AppConst::$mallName);
		echo Utils::output($ret);
    }

    /**
     * user login
     * @return string
     */
    public function actionLogin() {
		$request = Yii::$app->request;
		$code = $request->get('code');

		$conf = Utils::getConf();
		$wxLoginUrl = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$conf['appid'].'&secret='.$conf['appsecret'].'SECRET&js_code='.$code.'&grant_type=authorization_code';

		Yii::warning('wx usercode :'. $code.'   login url:'.$wxLoginUrl);

		$curl = new curl\Curl();
        $response = $curl->get($wxLoginUrl);
		Yii::warning('aaaaaaaaaaa  res:'.serialize($response));
        // List of status codes here http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
        switch ($curl->responseCode) {

            case 'timeout':
                //timeout error logic here
                break;
                
            case 200:
                //success logic here
                break;

            case 404:
                //404 Error logic here
                break;
        }
		echo $response;
    }

}
