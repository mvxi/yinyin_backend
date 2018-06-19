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
	 *  @detail page info
     * @return string
     */
    public function actionDetail()  {
		$request = Yii::$app->request;
		$productId = $request->get('product_id');
		$ret = array();
		
		$errno = Utils::RET_SUCCESS;
		$errmsg = '';
		if (strlen($productId) == self::ProductIdLen) {
			$productInfo = ProductInfo::find()->where(array('product_id' => $productId))->asArray()->one();
			if (strval($productInfo['detail_pic']) != '') {
				$productInfo['detail_pic'] = json_decode($productInfo['detail_pic']);
			} else {
				$productInfo['detail_pic'] = array();
				$productInfo['detail_pic'][] = $productInfo['cover_pic'];
			}
			$productInfo['introduction'] = '&nbsp;&nbsp;欢迎您来到 Yii Framework 中文网文档中心，我们为您精心准备了 Yii Framework 所有版本的中文文档，在此感谢为大家辛苦翻译的成员。<br>&nbsp;&nbsp; 由于我们的翻译成员有限，时间仓促，所以难免会有遗漏和翻译不准确的地方，请点此链接进入 GitHub 仓库修正问题。';
			$ret['detail'] = $productInfo;
		} else {
			$errno = Utils::RET_PARAM_ERROR;
			$errmsg = '输入参数参数错误';
		}
		echo Utils::output($ret, $errno, $errmsg);
	}
}
