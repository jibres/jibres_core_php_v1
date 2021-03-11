<?php
namespace lib\app\gift;


class check
{
	private static $user_id = null;
	private static $gift_id = null;

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

		self::$user_id = $data['user_id'];

		$code = $data['code'];
		if(!$code)
		{
			self::error(1, T_("Invalid gift code"), 'gift');
			return false;
		}

		$load = \lib\db\gift\get::by_code($code);

		if(!$load || !isset($load['id']))
		{
			self::error(1, T_("Invalid gift code"), 'gift');
			return false;
		}

		self::$gift_id = $load['id'];

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
				self::error(2, T_("This gift card is not enable for you"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
				return false;
			}
		}

		if(floatval($data['price']) < floatval($pricefloor))
		{
			self::error(5, T_("For use this gift code your cart amount must be larget than :val", ['val' => \dash\fit::number($pricefloor)]), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
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
									self::error(4, T_("This gift card only work on .ir domain"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
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
										self::error(4, T_("This gift card only work on .ir domain by domain period 1 year"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
										return false;
									}
								}
								else
								{
									self::error(4, T_("This gift card only work on .ir domain"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
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
										self::error(4, T_("This gift card only work on .ir domain by domain period 5 year"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
										return false;
									}
								}
								else
								{
									self::error(4, T_("This gift card only work on .ir domain"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
									return false;
								}
								break;
						}

					}
					else
					{
						self::error(4, T_("This gift card not working here!"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
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
			self::error(2, T_("This gift card is not enable"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
			return false;
		}

		// check expire time
		if(isset($load['dateexpire']) && $load['dateexpire'])
		{
			$expire_time = strtotime($load['dateexpire']);

			$left_time = $expire_time - time();

			if($left_time <= 0)
			{
				self::error(4, T_("This gift card is expired"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
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
				self::error(4, T_("Capacity of this gift card is full"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
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
				self::error(4, T_("You have used the maximum capacity of this discount code"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
				return false;
			}

			if(isset($load['category']) && $load['category'])
			{
				// get count of usage
				$get_usageperuser_category = \lib\db\gift\get::count_usaget_gift_id_user_id_by_category($data['user_id'], $load['category']);

				if(floatval($get_usageperuser_category) >= floatval($load['usageperuser']))
				{
					self::error(4, T_("You have used the maximum capacity of this group discount code"), ['target1' => '#giftcardmessageerror', 'timeout' => 10000]);
					return false;
				}
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

	private static function error($_level, $_msg)
	{
		$insert_log =
		[
			'from'   => self::$user_id,
			'data'   => ['level' => $_level, 'msg' => $_msg],
			'code'   => self::$gift_id,
		];

		\dash\log::set('invalid_gift_cart', $insert_log);

		if($_level === 1 || $_level === 2)
		{
			$this_hour           = date("Y-m-d H:i:s", (time() - (60*60)));

			$check_log           = [];
			$check_log['caller'] = 'invalid_gift_cart';

			$check_log['from']   = self::$user_id;

			$get_count_log = \dash\db\logs::count_where_date($check_log, $this_hour);

			if($get_count_log > 10)
			{
				\dash\waf\ip::isolateIP(5, 'invalid_gift_cart');
			}
			elseif($get_count_log > 50)
			{
				\dash\waf\ip::isolateIP(10, 'invalid_gift_cart > 50');
			}

		}

		\dash\data::gitfErrorMessage($_msg);
		\dash\notif::error($_msg);

	}
}
?>