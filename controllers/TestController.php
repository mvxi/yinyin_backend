<?php
namespace app\controllers;

use yii\web\Controller;

use app\widgets\Utils;
use app\widgets\AppConst;

use app\models\ProductInfo;

class TestController extends Controller
{
    /**
     * index page config
     * @return string
     */
    public function actionIndex() 
	{
		$product = new  ProductInfo();
		$product->product_id = Utils::idgen(AppConst::$objectType['product']);
		$product->name = '城野医生';
		$product->pic_url = 'https://www.duyinghao.com/images/chengyeyisheng.jpg';
		$product->cost_price= 61.3;
		$product->sell_price= 87.0;
		$product->sell_type = 1;
		$product->product_type = 1;
		$product->save();
		echo 'success';
    }
}
