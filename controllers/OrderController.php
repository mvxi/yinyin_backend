<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

use app\widgets\SessionKey;
use app\widgets\Utils;
use app\widgets\AppConst;

use app\models\OrderInfo;

class OrderController extends Controller {
    /**
     * index page config
     * @return string
     */
    public function actionCreate() {
		$request = Yii::$app->request;
		$yuid = $request->post('yuid', '');
		$productsInfo = $request->post('productsInfo', '');
		$remark = $request->post('remark', '');
		Yii::info('order-create yuid:'.$yuid.'  productsInfo:'.$productsInfo .'   remark:'.$remark );

		$yuserInfo = array();
		if (!empty($yuid)) {
			$yuserInfo = SessionKey::get($yuid);	
		} 

		$order = new  OrderInfo();
		$order->order_id = Utils::idgen(AppConst::$objectType['order']);
		$order->products_info = $productsInfo;
		$order->remark = $remark;
		$order->create_time = time();
		$order->open_id= $yuserInfo['openid'];
		$order->status = AppConst::$orderStatus['PP'];
		$order->save();

		$ret = array();
		$errno = Utils::RET_SUCCESS;
		$errmsg = '';
		echo Utils::output($ret, $errno, $errmsg);
    }
    /**
     * index page config
     * @return string
     */
    public function actionList() {
		$ret = array();
		$ret['banners'] = $this->bannersInfo();
		$ret['product_types'] = $this->productTypeInfo();
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
    private function productTypeInfo() {
		$ret = array();
		foreach (AppConst::$productType as $id=>$name) {
			$ret[] = array(
				'id' => $id,
				'name' => $name,
			);
		}
		return $ret;
    }

	public function init(){
	    $this->enableCsrfValidation = false;
	}
}
