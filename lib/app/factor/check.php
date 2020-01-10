<?php
namespace lib\app\factor;


class check
{


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function factor($_option = [])
	{
		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		$desc = \dash\app::request('desc');
		if($desc && mb_strlen($desc) > 1000)
		{
			\dash\notif::error(T_("Description of factor out of range"), 'desc');
			return false;
		}


		$type = \dash\app::request('type');
		if($type && !in_array($type, ['buy','sale','prefactor','lending','backbuy','backfactor','waste']))
		{
			\dash\notif::error(T_("Invalid type of factor"), 'type');
			return false;
		}

		if(!$type)
		{
			$type = 'sale';
		}


		$customer = \dash\app::request('customer');
		if(!$customer || $customer === '')
		{
			$customer = null;
		}

		if($customer)
		{
			$customer_id = \dash\coding::decode($customer);
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
					$customer = $customer_detail['id'];
				}
			}
			else
			{
				$customer = null;
			}
		}

		if(!$customer)
		{
			$mobile      = \dash\app::request('mobile');
			if($mobile)
			{
				$mobile = \dash\utility\filter::mobile($mobile);
				if(!$mobile)
				{
					\dash\notif::error(T_("Invalid mobile"), 'mobile');
					return false;
				}
			}

			$gender      = \dash\app::request('gender');

			if($gender && !in_array($gender, ['male', 'female']))
			{
				\dash\notif::error(T_("Invalid gender"), 'gender');
				return false;
			}

			$displayname = \dash\app::request('displayname');

			if($mobile)
			{
				$customer = \dash\app\user::quick_add(['mobile' => $mobile, 'gender' => $gender, 'displayname' => $displayname]);
			}
			else
			{
				if($displayname)
				{
					$check_exist_displayname = \dash\db\users::get_by_displayname($displayname);
					if(isset($check_exist_displayname['id']))
					{
						\dash\notif::error(T_("This thirdparyt already added to your store. plase set her mobile or change the name"), 'displayname');
					}
					else
					{
						$customer = \dash\app\user::quick_add(['mobile' => null, 'gender' => $gender, 'displayname' => $displayname]);
					}
				}
			}
		}

		$args                   = [];
		$args['customer']       = $customer;
		$args['type']           = $type;
		$args['seller']         = \dash\user::id();
		$args['date']           = date("Y-m-d H:i:s");
		$args['title']          = null;
		$args['pre']            = null;
		$args['transport']      = null;
		$args['pay']            = null;
		$args['subprice']      = null;
		$args['subdiscount'] = null;
		$args['detailtotalsum'] = null;
		$args['detailvat']      = null;
		$args['item']           = null;
		$args['qty']            = null;
		$args['discount']       = null;
		$args['sum']            = null;
		$args['status']         = null;
		$args['desc']           = $desc;

		return $args;
	}
}
?>