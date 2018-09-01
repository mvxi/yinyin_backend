<?php
namespace app\widgets;

use Yii;

class Utils {
	const RET_SUCCESS = 0;
	const RET_PARAM_ERROR = 10001;
	const RET_CALL_WX_ERROR = 10002;
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
    /**
     * load configs from app.conf
     */
    public static function getConf() {
		$xml = '/home/dodo/runtime/conf/yinyin/app.conf';
    	if (file_exists	($xml)) {  
    	    libxml_disable_entity_loader(false);  
    	    $xml_string = simplexml_load_file($xml,'SimpleXMLElement', LIBXML_NOCDATA);  
    	}else{  
    	    libxml_disable_entity_loader(true);  
    	    $xml_string = simplexml_load_string($xml,'SimpleXMLElement', LIBXML_NOCDATA);  
    	}  
    	$result = json_decode(json_encode($xml_string),true);  
    	return $result; 
	}
};
