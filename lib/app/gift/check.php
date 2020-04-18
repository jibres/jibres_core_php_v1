<?php
namespace lib\app\gift;


class check
{
	public static function check($_args)
	{
		$condition =
		[
			'code'    => 'string_100',
			'price'   => 'price',
			'user_id' => 'id',
		];

		$require = ['code', 'price', 'user_id'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$code = $data['code'];
		if(!$code)
		{
			\dash\notif::error(T_("Invalid gift code"), 'gift');
			return false;
		}

		$load = \lib\db\gift\get::by_code($code);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid gift code"), 'gift');
			return false;
		}

		$type        = null;
		$percent     = null;
		$amount      = null;
		$discount    = null;

		$giftpercent = (isset($load['giftpercent']) && $load['giftpercent']) 	? floatval($load['giftpercent']) 	: null;
		$giftamount  = (isset($load['giftamount']) && $load['giftamount']) 		? floatval($load['giftamount']) 	: null;
		$giftmax     = (isset($load['giftmax']) && $load['giftmax']) 			? floatval($load['giftmax']) 	: null;
		$pricefloor  = (isset($load['pricefloor']) && $load['pricefloor']) 		? floatval($load['pricefloor']) : null;

		if(floatval($data['price']) < floatval($pricefloor))
		{
			\dash\notif::error(T_("For use this gift code your cart amount must be larget than :val", ['val' => \dash\fit::number($pricefloor)]));
			return false;
		}

		if($giftpercent)
		{
			$type = 'percent';
			$discount = round((floatval($data['price']) * floatval($giftpercent)) / 100);
		}
		elseif($giftamount)
		{
			$type = 'amount';
		}

		$result                = [];
		$result['price']       = $data['price'];
		$result['discount']    = $discount;
		$result['giftpercent'] = $giftpercent;
		$result['giftamount']  = $giftamount;
		$result['type']        = $type;
		$result['finalprice']  = floatval($data['price']) - floatval($discount);
		$result['msgsuccess'] = (isset($load['msgsuccess']) && $load['msgsuccess']) 	? $load['msgsuccess'] 	: null;
		return $result;

	}
}
?>