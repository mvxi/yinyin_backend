<?php
namespace app\widgets;

use Yii;

class Utils {
    /**
     * {@inheritdoc}
     */
    public function output($ret, $errno=0) 
    {
		$arrRet = array(
			'errno' => $errno,
			'data' => $ret,
		);
		return json_encode($arrRet);
    }
};
