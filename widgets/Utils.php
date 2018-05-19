<?php
namespace app\widgets;

use Yii;

class Utils {
    /**
     * {@format output}
     */
    public static function output($ret, $errno=0) 
    {
		$arrRet = array(
			'errno' => $errno,
			'data' => $ret,
		);
		return json_encode($arrRet);
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
		}
		return $id;
    }
};
