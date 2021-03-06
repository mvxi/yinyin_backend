<?php
namespace app\widgets;

use Yii;

class AppConst {
	public static $mallName = array(
		'mallName' => '本真生活',
	);
	public static $productType = array(
		10 => '面部护理' ,
		11 => '身体护理',
		12 => '休闲食品',
		13 => '保健养生',
		14 => '休闲娱乐',
	);

	// internal code
	public static $indexBanners = array(
		'105b18d482d8664',
		'105b003b89a5e19',
		'105b003c3cb5a91',	
	);
	//generate object unique codes with objecttype as prefix
	public static $objectType = array(
		'product' => '10',
		'user' => '11',
		'order' => '12',
		'code' => '13',
		'address' => '14',
	);
	public static $brandCode = array(
		10 => 'DHC',
	);

	// http://www.cnstorm.com/index.php?route=information/help&line=20_41
	public static $orderStatus = array(
		'PP' => '1',  //pending payment
		'PR' => '2',  //processing
		'SH' =>  '3',  //shipped
		'CO' => '4', // completed
		'CA' => '5',  //canceled
		'VO' => '6',  //voided
	);
};
