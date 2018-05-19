<?php
namespace app\controllers;

use yii\web\Controller;

use app\widgets\Utils;
use app\widgets\AppConst;

use app\models\ProductInfo;

class IndexController extends Controller {
    /**
     * index page config
     * @return string
     */
    public function actionContent() {
		$ret = array();
		$ret['banners'] = $this->bannersInfo();
		echo Utils::output($ret);
    }

    /**
     * get bannerinfo from db.
     *
     * @return Response|string
     */
    private function bannersInfo() {
		$productInfos = ProductInfo::find()->where(array('in', 'product_id',  AppConst::$indexBanners))->asArray()->all();
		return $productInfos;
    }
}
