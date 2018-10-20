<?php

namespace app\models;

use yii\db\ActiveRecord;

class UserInfo extends ActiveRecord 
{
	public static function tableName() 
	{
		return 'product_info';
	}
}
