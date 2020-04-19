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
			'usein'   => 'string_100',
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
		if(!$load || !isset($load['id']))
		{
			\dash\notif::error(T_("Invalid gift code"), 'gift');
			return false;
		}

		$gift_id = $load['id'];

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
			$type     = 'percent';
			$discount = round((floatval($data['price']) * floatval($giftpercent)) / 100);
		}
		elseif($giftamount)
		{
			$type     = 'amount';
			$discount = floatval($giftamount);
		}

		// check forusein
		if(isset($load['forusein']) && $load['forusein'] && $data['usein'])
		{
			if($load['forusein'] !== $data['usein'] && $load['forusein'] !== 'any')
			{
				\dash\notif::error(T_("This gift card not working here!"));
				return false;
			}
		}

		// check max gift
		$finalprice = floatval($data['price']) - floatval($discount);

		if($giftmax && $discount > $giftmax)
		{
			$discount = $giftmax;
		}

		// check status
		if(isset($load['status']) && $load['status'] === 'enable')
		{
			// nothing
		}
		else
		{
			\dash\notif::error(T_("This gift card is not enable"));
			return false;
		}

		// check expire time
		if(isset($load['dateexpire']) && $load['dateexpire'])
		{
			$expire_time = strtotime($load['dateexpire']);

			$left_time = $expire_time - time();

			if($left_time <= 0)
			{
				\dash\notif::error(T_("This gift card is expired"));
				return false;
			}
		}


		// check count usage
		if(isset($load['usagetotal']) && $load['usagetotal'] && is_numeric($load['usagetotal']))
		{
			// get count of usage
			$get_usagetotal = \lib\db\gift\get::count_usaget_gift_id($gift_id);
			if(floatval($get_usagetotal) >= floatval($load['usagetotal']))
			{
				// update status
				// set date finish
				\dash\notif::error(T_("Capacity of this gift card is full"));
				return false;
			}
		}

		// check count usage per user
		if(isset($load['usageperuser']) && $load['usageperuser'] && is_numeric($load['usageperuser']))
		{
			// get count of usage
			$get_usageperuser = \lib\db\gift\get::count_usaget_gift_id_user_id($gift_id, $data['user_id']);
			if(floatval($get_usageperuser) >= floatval($load['usageperuser']))
			{
				\dash\notif::error(T_("You have used the maximum capacity of this discount code"));
				return false;
			}
		}


		$result                = [];
		$result['price']       = $data['price'];
		$result['discount']    = $discount;
		$result['giftpercent'] = $giftpercent;
		$result['giftamount']  = $giftamount;
		$result['type']        = $type;

		$result['msgsuccess'] = (isset($load['msgsuccess']) && $load['msgsuccess']) 	? $load['msgsuccess'] 	: null;

		return $result;
	}
}
?>