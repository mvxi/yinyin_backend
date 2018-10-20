<?php
namespace app\widgets;

use Yii;

class Spam {
	const RET_SUCCESS = 0;
    /**
     * {@format output}
     */
    public static function checkYuid($yuid) 
    {
		$ret = false;
		$arrRet = array(
			'errno' => $errno,
			'errmsg' => $errmsg,
			'data' => $ret,
		);
		return $ret;
    }
};
