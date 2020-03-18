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
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$condition =
		[
			'desc'        => 'desc',
			'type'        => ['enum' => ['buy','sale','prefactor','lending','backbuy','backfactor','waste']],
			'customer'    => 'code',
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


		return $data;
	}
}
?>