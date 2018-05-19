<?php

namespace app\controllers;

use yii\web\Controller;
use app\widgets\Utils;
use app\widgets\AppConst;

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

}
