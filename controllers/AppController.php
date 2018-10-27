<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\widgets\Utils;
use app\widgets\AppConst;
use app\widgets\SessionKey;
use yii\curl;

use app\models\UserInfo;
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

	private function getYuid($sk, $openid, $yuserInfo, $yuid='') {
		$retYuid = $yuid;
		if (empty($yuserInfo) || strval($yuserInfo['sk'])!=$sk) {
			$retYuid = SessionKey::set($sk, $openid, $yuid);	
		}
		if (empty($yuserInfo) && !empty($retYuid)) {   //openid stored into db
			$userInfo = UserInfo::find()->where(array('open_id' => $openid))->one();
			if (empty($userInfo)) {
				$userInfo = new UserInfo;
				$userInfo->yuid = $retYuid;
				$userInfo->open_id = $openid;
				$userInfo->save();
			} else {
				$userInfo->yuid = $retYuid;
				$userInfo->save();
			}
		}
		return $retYuid;
	}

    /**
     * get wx user info by jscode2session
     * @return string
     */
	private function getWXInfo($code, $yuid='') {
		$yuserInfo = array();
		if (!empty($yuid)) {
			$yuserInfo = SessionKey::get($yuid);	
		} 

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
				$ret['yuid'] = $this->getYuid($arrRes['session_key'], $arrRes['openid'], $yuserInfo, $yuid);
				/*
				if ($arrRes['errcode'] == 0) {
					$ret['yuid'] = $this->getYuid($arrRes['session_key'], $arrRes['openid'], $yuserInfo, $yuid);
				} else {
				}
				*/
                break;
            case 404:
				$errno = Utils::RET_CALL_WX_ERROR;
				$errmsg = '微信服务异常';
                break;
        }
		//
		Yii::info('wx usercode :'. $code.'   login url:'.$wxLoginUrl.'     response:'.serialize($res).'   newyuid:'.$ret['yuid'].'   oldyuid:'.$yuid.'   new_sk:'.$arrRes['session_key'].'     old_sk:'.serialize($yuserInfo));
		return $ret;
	}

    /**
     * user login
     * @return string
     */
    public function actionLogin() {
		$request = Yii::$app->request;
		$code = $request->get('code', '');
		$yuid = $request->get('yuid', '');
		$userHost = $request->userHost;
		$userIP = $request->userIP;
		Yii::info('login params  code:'.$code.'   yuid:'.$yuid.'   host:'.$userHost.'   ip:'.$userIP);
		
		$ret = array();
		$errno = Utils::RET_SUCCESS;
		$errmsg = '';
		$ret = $this->getWXInfo($code, $yuid);
		echo Utils::output($ret, $errno, $errmsg);
    }
}
