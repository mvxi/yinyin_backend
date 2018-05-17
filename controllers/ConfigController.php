<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

use app\widgets\Utils;

class ConfigController extends Controller
{
    /**
     * app config
     * @return string
     */
    public function actionApp() {
		$config = array(
			'mallname' => '纯真生活',
		);
        $util = new Utils();
		echo $util->output($config);
    }

    /**
     * index page config
     * @return string
     */
    public function actionIndex() {
		$config = array(
			'banners' => '纯真生活',
		);
        $util = new Utils();
		echo $util->output($config);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
	echo "hello world";
    }

}
