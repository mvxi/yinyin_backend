<?php

namespace app\models;

use yii\db\ActiveRecord;

class OrderInfo extends ActiveRecord 
{
	public static function tableName() 
	{
		return 'order_info';
	}
}
