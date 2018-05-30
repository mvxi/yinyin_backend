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
		$ret['categories'] = $this->catagoryInfo();
		echo Utils::output($ret);
    }
    /**
     * get bannerinfo from db.
     * @return Response|string
     */
    private function bannersInfo() {
		$productInfos = ProductInfo::find()->where(array('in', 'product_id',  AppConst::$indexBanners))->asArray()->all();
		return $productInfos;
    }
    /**
     * get catagorynfo. we can set it manually because of not too many
     * @return Response|string
     */
    private function catagoryInfo() {
		$ret = array();
		foreach (AppConst::$indexCatagory  as $id=>$name) {
			$ret[] = array(
				'id' => $id,
				'name' => $name,
			);
		}
		return $ret;
    }
    /**
     * index page config
     * @return string
     */
    public function actionNoticeTips() {
		$ret = array();
		$ret['banners'] = $this->bannersInfo();
		$ret['catagory'] = $this->catagoryInfo();
		echo Utils::output($ret);
    }
}
