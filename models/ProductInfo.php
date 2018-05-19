<?php

namespace app\models;

use yii\db\ActiveRecord;

class ProductInfo extends ActiveRecord 
{
	public static function tableName() 
	{
		return 'product_info';
	}
}
