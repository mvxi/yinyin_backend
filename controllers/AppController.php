<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\widgets\Utils;
use app\widgets\AppConst;
use app\widgets\SessionKey;
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

	private function getYuid($sk, $openid) {
		return SessionKey::set($sk, $openid);	
	}
    /**
     * user login
     * @return string
     */
    public function actionLogin() {
		$request = Yii::$app->request;
		$code = $request->get('code');

		$conf = Utils::getConf();
		$wxLoginUrl = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$conf['appid'].'&secret='.$conf['appsecret'].'&js_code='.$code.'&grant_type=authorization_code';

		$curl = new curl\Curl();
        $res = $curl->get($wxLoginUrl);
		
		$ret = array();
		$errno = Utils::RET_SUCCESS;
		$errmsg = '';
        switch ($curl->responseCode) {
            case 'timeout':
				$errno = Utils::RET_CALL_WX_ERROR;
				$errmsg = '请求微信服务超时';
                break;
            case 200:
				$arrRes = json_decode($res, true);
				$ret['yuid'] = $this->getYuid($arrRes['session_key'], $arrRes['openid']);
                break;
            case 404:
				$errno = Utils::RET_CALL_WX_ERROR;
				$errmsg = '微信服务异常';
                break;
        }
		Yii::warning('wx usercode :'. $code.'   login url:'.$wxLoginUrl.'     response:'.serialize($res).'   yuid:'.$ret['yuid'] );
		echo Utils::output($ret, $errno, $errmsg);
    }

}
