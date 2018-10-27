<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

use app\widgets\Utils;
use app\widgets\AppConst;

use app\models\ProductInfo;
use app\models\UserInfo;

class InputController extends Controller
{
///////////  product 
    public function actionAdd() 
	{
		$product = new  ProductInfo();
		$product->product_id = Utils::idgen(AppConst::$objectType['product']);
		$product->name = '城野医生';
		$product->cover_pic = 'https://www.duyinghao.com/images/chengyeyisheng.jpg';
		$product->cost_price= 61.3;
		$product->sell_price= 87.0;
		$product->sell_type = 1;
		$product->product_type = 1;

		$arrDetailPic = array('https://www.duyinghao.com/images/chengyeyisheng.jpg', 
					'https://www.duyinghao.com/images/chengyeyisheng.jpg');
		$product->detail_pic = json_encode($arrDetailPic);
		$product->save();
		echo 'success';
    }
    public function actionUpdate() 
	{
		$arr = array();
		$product = ProductInfo::findOne(171);
		$arr[] = $product->pic_url;
		$product->pic_url = json_encode($arr);
		$product->save();
		echo $product->pic_url;
    }
    public function actionRead() 
	{
		$arr = array();
		$product = ProductInfo::findOne(171);
		$url = json_decode($product->pic_url);
		echo $url[0];
    }
    public function actionRecovery() 
	{
		$arr = array();
		$product = ProductInfo::findOne(170);
		$url = json_decode($product->pic_url);
		$product->pic_url = $url[0];
		$product->save();
    }

///////////   redis
    public function actionAddredis() 
	{
		$source = Yii::$app->redis->set('var1','asdasd');
		echo 'success';

    }
    public function actionGetredis() 
	{
		$source = Yii::$app->redis->get('115bbc6e6264a87_sk');
		var_dump($source);

    }

//////////// user
    public function actionGetAdd() 
	{
		UserInfo::findBySql('')->one();
    }

    public function actionUserAdd() 
	{

		$user = new  UserInfo();
		$user->open_id = '022wmfGH1tSSF70KvoIH1WW4GH1wmfGH';
		$user->share_code = 'share_code0';
		$user->share_code1 = 'share_code1';
		$user->address = '北京市海淀区上地十街10号';
		$user->yuid = '115bcd4809d3c51';
		$user->wx_name = '小五花肉1';

		$user->save();
		echo 'success';
    }
}
