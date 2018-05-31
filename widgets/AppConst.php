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
		'105b0019c0dcceb',
		'105b003b89a5e19',
		'105b003c3cb5a91',	
	);
	public static $objectType = array(
		'product' => '10',
		'user' => '11',
		'order' => '122',
	);
	public static $brandCode = array(
		10 => 'DHC',
	);
};
