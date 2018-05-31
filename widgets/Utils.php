<?php
namespace app\widgets;

use Yii;

class Utils {
	const RET_SUCCESS = 0;
	const RET_PARAM_ERROR = 10001;
    /**
     * {@format output}
     */
    public static function output($ret, $errno=0, $errmsg='') 
    {
		$arrRet = array(
			'errno' => $errno,
			'errmsg' => $errmsg,
			'data' => $ret,
		);
		return json_encode($arrRet, JSON_UNESCAPED_UNICODE);
    }


    /**
     * {@idgen }
     */
    public static function idgen($type) 
    {
		$id = uniqid();
		if (intval($type) > 0) 
		{
			$id = $type . $id;
		} else  
		{
			$id = 0;
		}
		return $id;
    }
};
