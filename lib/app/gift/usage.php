<?php
namespace lib\app\gift;


class usage
{
	public static function set($_args)
	{
		$condition =
		[
			'code'            => 'string_100',
			'transaction_id'  => 'id',
			'price'           => 'price',
			'user_id'         => 'id',
			'discount'        => 'price',
			'discountpercent' => 'percent',
			'finalprice'      => 'price',
		];

		$require = ['code', 'price', 'user_id'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$code = $data['code'];

		$load = \lib\db\gift\get::by_code($code);
		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$insert_usage =
		[
			'gift_id'         => $load['id'],
			'user_id'         => $data['user_id'],
			'transaction_id'  => $data['transaction_id'],
			'price'           => $data['price'],
			'discount'        => $data['discount'],
			'discountpercent' => $data['discountpercent'],
			'finalprice'      => $data['finalprice'],
			'datecreated'     => date("Y-m-d H:i:s"),
		];

		$usage_id = \lib\db\gift\insert::new_record_usage($insert_usage);

		return $usage_id;


	}
}
?>