<?php
namespace app\controllers;

use yii\web\Controller;

use app\widgets\Utils;
use app\widgets\AppConst;

class IndexController extends Controller
{
    /**
     * index page config
     * @return string
     */
    private function actionIndex() 
	{
		$ret = array();
		$ret['banners'] = $this->bannersInfo();
		echo Utils::output($ret);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    private function bannersInfo() {
		$banners = array(
		);
		return $banners;
    }
}
