<?php

namespace app\widgets;

use Yii;
use app\widgets\Utils;

class SessionKey
{
	const SESSION_KEY_PREFIX = '_sk';
	const SESSION_TIMEOUT = 10*24*3600;
    /**
     * set session key and opendi from tencent server  into redis, meanwhile return a corresponding secure string
     */
    public static function set($sk, $openid, $yuid='') 
    {
		$info = $sk.','.$openid;
		if ($yuid == '') 
		{
			$yuid = Utils::idgen(AppConst::$objectType['user']);
		}
		$key = $yuid.self::SESSION_KEY_PREFIX;
		$res = Yii::$app->redis->set($key, $info);
		Yii::$app->redis->expire($key, self::SESSION_TIMEOUT);
		Yii::trace('set redis key:'.$key.'  value:'.$info.'  res:'.$res.'   yuid:'.$yuid);
		return $yuid;
	}
	
    public static function get($yuid) 
    {
		$ret = array();
		if (!empty($yuid)) {
			$key = $yuid.self::SESSION_KEY_PREFIX;
			$source = Yii::$app->redis->get($key);
			if (!empty($source)) 
			{
				$arrSource = explode(',', $source);
				$ret['sk'] = $arrSource[0];
				$ret['openid'] = $arrSource[1];
			}
		}
		return $ret;
	}
};
