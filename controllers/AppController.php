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


		$curl = new curl\Curl();
        //get http://example.com/
        $response = $curl->post('http://example.com');
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
