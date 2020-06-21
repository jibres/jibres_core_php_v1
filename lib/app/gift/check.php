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
			'domain'  => 'string_200',
			'domain_period' => 'string_200',
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

		$gift_id     = $load['id'];

		$type        = null;
		$percent     = null;
		$amount      = null;
		$discount    = null;

		$giftpercent = (isset($load['giftpercent']) && $load['giftpercent']) 	? floatval($load['giftpercent']) 	: null;
		$giftamount  = (isset($load['giftamount']) && $load['giftamount']) 		? floatval($load['giftamount']) 	: null;
		$giftmax     = (isset($load['giftmax']) && $load['giftmax']) 			? floatval($load['giftmax']) 		: null;
		$pricefloor  = (isset($load['pricefloor']) && $load['pricefloor']) 		? floatval($load['pricefloor']) 	: null;
		$dedicated   = (isset($load['dedicated']) && $load['dedicated']) 		? $load['dedicated'] 				: null;

		if($dedicated && is_string($dedicated))
		{
			$dedicated = json_decode($dedicated, true);
		}

		if(!is_array($dedicated))
		{
			$dedicated = [];
		}

		if($dedicated)
		{
			if(!in_array(\dash\user::detail('mobile'), $dedicated))
			{
				\dash\notif::error(T_("This gift card is not enable for you"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
				return false;
			}
		}

		if(floatval($data['price']) < floatval($pricefloor))
		{
			\dash\notif::error(T_("For use this gift code your cart amount must be larget than :val", ['val' => \dash\fit::number($pricefloor)]), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
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
			if($load['forusein'] === 'any')
			{
				// ok
				// this gitf card can use in any place
			}
			else
			{
				if($load['forusein'] !== $data['usein'])
				{
					if(in_array($load['forusein'], ['ir_domain', 'ir_domain_1','ir_domain_5']))
					{
						switch ($load['forusein'])
						{
							case 'ir_domain':
								if(\dash\validate::ir_domain($data['domain'], false))
								{
									// ok
								}
								else
								{
									\dash\notif::error(T_("This gift card only work on .ir domain"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
									return false;
								}
								break;

							case 'ir_domain_1':
								if(\dash\validate::ir_domain($data['domain'], false))
								{
									if(intval($data['domain_period']) === 1)
									{
										// ok
									}
									else
									{
										\dash\notif::error(T_("This gift card only work on .ir domain by domain period 1 year"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
										return false;
									}
								}
								else
								{
									\dash\notif::error(T_("This gift card only work on .ir domain"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
									return false;
								}
								break;

							case 'ir_domain_5':
								if(\dash\validate::ir_domain($data['domain'], false))
								{
									if(intval($data['domain_period']) === 5)
									{
										// ok
									}
									else
									{
										\dash\notif::error(T_("This gift card only work on .ir domain by domain period 5 year"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
										return false;
									}
								}
								else
								{
									\dash\notif::error(T_("This gift card only work on .ir domain"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
									return false;
								}
								break;
						}

					}
					else
					{
						\dash\notif::error(T_("This gift card not working here!"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
						return false;
					}

				}

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
			\dash\notif::error(T_("This gift card is not enable"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
			return false;
		}

		// check expire time
		if(isset($load['dateexpire']) && $load['dateexpire'])
		{
			$expire_time = strtotime($load['dateexpire']);

			$left_time = $expire_time - time();

			if($left_time <= 0)
			{
				\dash\notif::error(T_("This gift card is expired"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
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
				\dash\notif::error(T_("Capacity of this gift card is full"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
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
				\dash\notif::error(T_("You have used the maximum capacity of this discount code"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
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