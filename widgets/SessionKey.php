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
    public static function set($sk, $openid) 
    {
		$info = $sk.','.$openid;
		$yuid = Utils::idgen(AppConst::$objectType['user']);
		$key = $yuid.self::SESSION_KEY_PREFIX;
		$res = Yii::$app->redis->set($key, $info);
		Yii::$app->redis->expire($key, self::SESSION_TIMEOUT);
		return $yuid;
	}
	
    public static function get($yuid) 
    {
		$ret = array();
		$source = Yii::$app->redis->get('var1');
		return $ret;
	}
};
