<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\widgets\Utils;
use app\widgets\AppConst;
use app\widgets\SessionKey;

use app\models\UserInfo;

class UserController extends Controller {
    /**
     * add a new address
     * @return string
     */
    private function setAddress($isAdd = true) {
		$request = Yii::$app->request;
		$yuid = $request->get('yuid', '');
		$addressId = $request->get('addressId', '');
		$provinceId = $request->get('provinceId', 0);
		$cityId = $request->get('cityId', 0);
		$districtId = $request->get('districtId', 0);
		$address = $request->get('address', '');
		$mobile = $request->get('mobile', '');
		$code = $request->get('code', 0);
		$isDefault = $request->get('isDefault', 0);
		$cp = $request->get('linkMan', '');  //contract person
		
		$ret = array();
		$yuserInfo = SessionKey::get($yuid);	
		if (!empty($yuserInfo)) {
			$userInfo = UserInfo::find()->where(array('open_id' => $yuserInfo['openid']))->one();
			Yii::trace('setaddress  yuid:'.$yuid.'   yuserinfo:'.serialize($yuserInfo).'    ret_userinfo:'.serialize($userInfo));
			if (!empty($userInfo)) {
				$isNew = true;
				$arrAddress = json_decode($userInfo->address, true);
				if (empty($arrAddress)) {
					$arrAddress = array();
				}
				foreach ($arrAddress as &$addItem) {
					if ($addItem['addressId'] == $addressId) {
						$isNew = false;
						$addItem['addressId'] = $addressId;
						$addItem['provinceId'] = $provinceId;
						$addItem['cityId'] = $cityId;
						$addItem['address'] = $address;
						$addItem['districtId'] = $districtId;
						$addItem['mobile'] = $mobile;
						$addItem['code'] = $code;
						$addItem['isDefault'] = $isDefault;
						$addItem['cp'] = $cp;
					}
				}
				if ($isNew) {
					$arrAddress[] = array(
						'addressId' => Utils::idgen(AppConst::$objectType['address']),
						'provinceId' => $provinceId,
						'cityId' => $cityId,
						'address' => $address,
						'districtId' => $districtId,
						'mobile' => $mobile,
						'code' => $code,
						'isDefault' => $isDefault,
						'cp' => $cp,
					);
				}
				$userInfo->address = json_encode($arrAddress);
				$userInfo->save();
			}
		}
		Yii::info('address update yuid:'.$yuid.'   addressid:'.$addressId.'  provinceid:'.$provinceId.'   cityid:'.$cityId .'   districtid:'.$districtId.'   address:'.$address.'   mobile:'.$mobile.'   code:'.$code.'   cp:'.$cp.'  openid:' );
	}

    /**
     * get  address list
     * @return string
     */
    private function getAddressList() {
		$request = Yii::$app->request;
		$yuid = $request->get('yuid', '');
		$addressId = $request->get('addressId', '');

		$arrAddress = array();
		$yuserInfo = SessionKey::get($yuid);	
		if (!empty($yuserInfo)) {
			$userInfo = UserInfo::find()->where(array('open_id' => $yuserInfo['openid']))->one();
			Yii::trace('setaddress  yuid:'.$yuid.'   yuserinfo:'.serialize($yuserInfo).'    ret_userinfo:'.serialize($userInfo));
			if (!empty($userInfo)) {
				$isNew = true;
				$arrAddressTemp = json_decode($userInfo->address, true);
				if (empty($arrAddressTemp)) {
					$arrAddress = array();
				} else if ($addressId != '') {
					foreach($arrAddressTemp as $addressItem) {
						if ($addressId == $addressItem['addressId']) {
							$arrAddress[] = $addressItem;
						}
					}
				} else {
					$arrAddress = $arrAddressTemp;
				}
			}
		}
		return $arrAddress;
	}

    /**
     * del  address list
     * @return string
     */
    private function delAddress() {
		$request = Yii::$app->request;
		$yuid = $request->get('yuid', '');
		$addressId = $request->get('addressId', '');
		$ret = false;
		$yuserInfo = SessionKey::get($yuid);	
		if (!empty($yuserInfo)) {
			$userInfo = UserInfo::find()->where(array('open_id' => $yuserInfo['openid']))->one();
			Yii::trace('deldress  yuid:'.$yuid.'  addressId:'.$addressId.'   yuserinfo:'.serialize($yuserInfo).'    ret_userinfo:'.serialize($userInfo));
			if (!empty($userInfo)) {
				$arrAddress = json_decode($userInfo->address, true);
				if (empty($arrAddress)) {
					$arrAddress = array();
				}
				$arrAddressNew = array();
				foreach ($arrAddress as $addItem) {
					if ($addItem['addressId'] != $addressId) {
						$arrAddressNew[] = $addItem;
					}
				}
				$userInfo->address = json_encode($arrAddressNew);
				$userInfo->save();
				$ret = true;
			}
		}
		return $ret;
	}


    /**
     * add a new address
     * @return string
     */
    public function actionAddressAdd() {
		$ret = array();
		$errno = Utils::RET_SUCCESS;
		$errmsg = '';
		$ret = $this->setAddress();
		echo Utils::output($ret, $errno, $errmsg);
    }
    /**
     * update address info
     * @return string
     */
    public function actionAddressUpdate() {
		$ret = array();
		$errno = Utils::RET_SUCCESS;
		$errmsg = '';
		$ret = $this->setAddress(false);
		echo Utils::output($ret, $errno, $errmsg);
    }
    /**
     * get address list
     * @return string
     */
    public function actionAddressGetList() {
		$ret = array();
		$errno = Utils::RET_SUCCESS;
		$errmsg = '';
		$ret = $this->getAddressList();
		echo Utils::output($ret, $errno, $errmsg);
    }
    /**
     * get address list
     * @return string
     */
    public function actionAddressGetDefault() {
		$ret = array();
		$errno = Utils::RET_SUCCESS;
		$errmsg = '';
		$list = $this->getAddressList();
		foreach ($list as $item) {
			if ($item['isDefault'] == '1') {
				$ret = $item;
				break;
			}
		}
		echo Utils::output($ret, $errno, $errmsg);
    }
    /**
     * delete address 
     * @return string
     */
    public function actionAddressDel() {
		$ret = array();
		$errno = Utils::RET_SUCCESS;
		$errmsg = '';
		$ret = $this->delAddress();
		echo Utils::output($ret, $errno, $errmsg);
    }
}
