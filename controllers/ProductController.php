<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

use app\widgets\Utils;
use app\widgets\AppConst;

use app\models\ProductInfo;

class ProductController extends Controller {
	const ProductIdLen = 15;
    /**
     * index page config
     * @return string
     */
    public function actionList()  {
		$request = Yii::$app->request;
		$productTypeID = $request->get('product_type');
		$offset = $request->get('offset', 0);
		$limit = $request->get('limit', 10);
		$productList = array();
		if (intval($productTypeID) > 0) {
			$productList = ProductInfo::find()->where(array('product_type' => $productTypeID))->orderBy('id ASC')->offset($offset * $limit)->limit($limit)->asArray()->all();
		}
		echo Utils::output($ret);
    }

    /**
     * index page config
     * @return string
     */
    public function actionDetail()  {
		$request = Yii::$app->request;
		$productId = $request->get('product_id');
		$productInfo = array();
		
		$errno = Utils::RET_SUCCESS;
		$errmsg = '';
		if (strlen($productId) == self::ProductIdLen) {
			$productInfo = ProductInfo::find()->where(array('product_id' => $productId))->asArray()->one();
		} else {
			$errno = Utils::RET_PARAM_ERROR;
			$errmsg = '输入参数参数错误';
		}
		echo Utils::output($productInfo, $errno, $errmsg);
	}
}
