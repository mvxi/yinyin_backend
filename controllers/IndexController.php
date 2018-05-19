<?php
namespace app\controllers;

use yii\web\Controller;

use app\widgets\Utils;
use app\widgets\AppConst;

class IndexController extends Controller
{
    /**
     * index config
     * @return string
     */
    public function actionConfig() 
	{
		$ret = array();
		$ret = array_merge($ret, AppConst::$mallName);
		echo Utils::output($ret);
    }

    /**
     * index page config
     * @return string
     */
    private function actionIndex() 
	{
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
