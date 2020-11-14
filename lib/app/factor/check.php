<?php
namespace lib\app\factor;


class check
{


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function factor($_args, $_option = [])
	{
		$default_option =
		[
			'debug'         => true,
			'factor_detail' => [],
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$condition =
		[
			'desc'        => 'desc',
			'discount'    => 'price',
			'shipping'    => 'price',
			'type'        =>
			[
				'enum' =>
				[
					'buy',
					'sale',
					// 'prefactor',
					'lending',
					'backbuy',
					// 'backfactor',
					'waste',
					'saleorder'
				]
			],

			'status'      =>
			[
				'enum' =>
				[
					'enable',
					'disable',
					'draft',
					'order',
					'expire',
					'cancel',
					'pending_pay',
					'pending_verify',
					'pending_prepare',
					'pending_send',
					'sending',
					'deliver',
					'reject',
					'spam',
					'deleted'
				]
			],

			'customer'    => 'code',
			'guestid'     => 'md5',
			'address_id'  => 'code',
			'mobile'      => 'mobile',
			'displayname' => 'displayname',
			'gender'      => ['enum' => ['male', 'female']],
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['type'])
		{
			$data['type'] = 'sale';
		}


		if($data['customer'])
		{
			$customer_id = \dash\coding::decode($data['customer']);
			if($customer_id)
			{
				$customer_detail = \dash\db\users::get_by_id($customer_id);
				if(!isset($customer_detail['id']))
				{
					\dash\notif::error(T_("Customer detail is invalid"), 'customer');
					return false;
				}
				else
				{
					$data['customer'] = $customer_detail['id'];
				}
			}
			else
			{
				$data['customer'] = null;
			}
		}

		if(!$data['customer'])
		{

			if($data['mobile'])
			{
				$data['customer'] = \dash\app\user::quick_add(['mobile' => $data['mobile'], 'gender' => $data['gender'], 'displayname' => $data['displayname']]);
			}
			else
			{
				if($data['displayname'])
				{
					$check_exist_displayname = \dash\db\users::get_by_displayname($data['displayname']);
					if(isset($check_exist_displayname['id']))
					{
						\dash\notif::error(T_("This thirdparyt already added to your store. plase set her mobile or change the name"), 'displayname');
					}
					else
					{
						$data['customer'] = \dash\app\user::quick_add(['mobile' => null, 'gender' => $data['gender'], 'displayname' => $data['displayname']]);
					}
				}
			}
		}

		unset($data['mobile']);
		unset($data['displayname']);
		unset($data['gender']);

		if($data['discount'])
		{
			$data['discount'] = \lib\price::up($data['discount']);
			$data['discount'] = \lib\number::up($data['discount']);
		}

		if($data['shipping'])
		{
			$data['shipping'] = \lib\price::up($data['shipping']);
			// $data['discount'] = \lib\number::up($data['discount']);
		}


		if($data['address_id'])
		{
			$data['address_id'] = \dash\coding::decode($data['address_id']);

			$customer_id = $data['customer'];

			if(!$customer_id && isset($_option['factor_detail']['customer']) && $_option['factor_detail']['customer'])
			{
				$customer_id = \dash\coding::decode($_option['factor_detail']['customer']);
			}

			if(!$customer_id)
			{
				\dash\notif::error(T_("Order have not customer and you cannot add address to this"));
				return false;
			}

			$data['customer'] = $customer_id;

			$check_user_address = \dash\db\address::get_user_address_active($customer_id, $data['address_id']);

			if(!$check_user_address)
			{
				\dash\notif::error(T_("Invalid user address"));
				return false;
			}
		}

		return $data;
	}
}
?>