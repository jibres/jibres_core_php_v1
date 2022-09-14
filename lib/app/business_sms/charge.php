<?php

namespace lib\app\business_sms;

class charge
{

	public static function getDetail()
	{
		$detail = \lib\api\jibres\api::business_sms_detail();

		if(isset($detail['result']))
		{
			return $detail['result'];
		}

		return [];
	}


	public static function newPay(array $_args)
	{
		$data = self::checkArgs($_args);

		var_dump($data);
		exit();
	}


	private static function checkArgs(array $_args)
	{
		$condition =
			[
				'turn_back'  => 'string_1000',
				'use_budget' => 'bit',
				'amount'     => 'price',
			];

		$require = ['amount'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


}