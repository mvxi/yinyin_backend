<?php
namespace app\controllers;

use yii\web\Controller;

use app\widgets\Utils;
use app\widgets\AppConst;


class UserController extends Controller {
    /**
     * add a new address
     * @return string
     */
    public function actionAddressAdd() {
		$request = Yii::$app->request;
		$yuid = $request->get('yuid', '');
		$addressId = $request->get('addressId', '');
		$proviceId = $request->get('proviceId', 0);
		$cityId = $request->get('cityId', 0);
		$districtId = $request->get('districtId', 0);
		$address = $request->get('address', '');
		$mobile = $request->get('mobile', '');
		$code = $request->get('code', 0);
		$isDefault = $request->get('isDefault', 0);
		$cp = $request->get('linkMan', '');  //contract person
		
		$userInfo = UserInfo::find()->where(array('yuid' => $yuid))->asArray()->one();
		if ($addressId == '') {
		} else {
		}
	    	
		$ret = array();
		$ret['banners'] = $this->bannersInfo();
		$ret['product_types'] = $this->productTypeInfo();
		echo Utils::output($ret);
    }
    /**
     * update address info
     * @return string
     */
    public function actionAddressUpdate() {
		$request = Yii::$app->request;
		$yuid = $request->get('yuid', '');
		$openId = $request->get('open_id', '');
		$buyCount = $request->get('buy_count', 10);
		$ret = array();
		$ret['banners'] = $this->bannersInfo();
		$ret['product_types'] = $this->productTypeInfo();
		echo Utils::output($ret);
    }
}
