<?php
namespace lib\app\sms;

class check
{
	public static function variable($_args)
	{
		$condition =
		[
			'mobile'  => 'mobile',
			'message' => 'desc',
			'sender'  => ['enum' => ['system', 'admin', 'customer']],
		];

		$require = ['mobile', 'message'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$data['len']      = mb_strlen($data['message']);
		$data['smscount'] = ceil($data['len'] / 70);

		return $data;
	}

}
?>