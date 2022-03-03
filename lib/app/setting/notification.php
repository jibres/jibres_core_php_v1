<?php
namespace lib\app\setting;


class notification
{
	private static $setting = false;

	public static function get_sample()
	{
		$args =
		[
		  'data' =>
		  [
		    'my_id'            => '...',
		    'my_amount'        => '...',
		    'my_currency'      => \lib\store::currency(),
		    'my_tackingnumber' => '...',
		    'my_hide_link'     => true,
		  ],
		];

		$sample =
		[

		  'before_pay' =>
		  [
			'title'  => T_("Before pay"),
			'text'   => \lib\app\log\caller\order\order_adminNewOrderBeforePay::get_msg($args),
			'active' => self::is_enable('before_pay'),
			'fn'     => '\\lib\\app\\log\\caller\\order\\order_adminNewOrderBeforePay',
		  ],

		  'after_pay' =>
		  [
			'title'  => T_("After pay"),
			'text'   => \lib\app\log\caller\order\order_adminNewOrderAfterPay::get_msg($args),
			'active' => self::is_enable('after_pay'),
			'fn'     => '\\lib\\app\\log\\caller\\order\\order_adminNewOrderAfterPay',
		  ],

		  'new_order' =>
		  [
			'title'  => T_("New order"),
			'text'   => \lib\app\log\caller\order\order_customerNewOrder::get_msg($args),
			'active' => self::is_enable('new_order'),
			'fn'     => '\\lib\\app\\log\\caller\\order\\order_customerNewOrder',
		  ],

		  'sending_order' =>
		  [
			'title'  => T_("Sending order"),
			'text'   => \lib\app\log\caller\order\order_customerSendingOrder::get_msg($args),
			'active' => self::is_enable('sending_order'),
			'fn'     => '\\lib\\app\\log\\caller\\order\\order_customerSendingOrder',
		  ],

		  'tracking_number' =>
		  [
			'title'  => T_("Tracking number"),
			'text'   => \lib\app\log\caller\order\order_customerTrackingNumber::get_msg($args),
			'active' => self::is_enable('tracking_number'),
			'fn'     => '\\lib\\app\\log\\caller\\order\\order_customerTrackingNumber',
		  ],

		];

		return $sample;
	}


	public static function get_sample_user($_user_code)
	{
		$sample = self::get_sample();

		$user_detail = \dash\app\user::get($_user_code);


		$load_permission = [];

		if(a($user_detail, 'permission'))
		{
			if($user_detail['permission'] === 'admin')
			{
				$load_permission[] = 'admin';
			}
			else
			{
				$load_permission = \dash\app\permission\get::load_allow_permission_caller($user_detail['permission']);
			}
		}

		$user_id = \dash\coding::decode($_user_code);


		$new_list = [];


		foreach ($sample as $key => $value)
		{
			$send_to_this_user = true;

			if(a($value, 'fn'))
			{
				if(is_callable([$value['fn'], 'send_to']))
				{
					$send_to_this_user = false;

					$send_to = call_user_func([$value['fn'], 'send_to']);

					if(is_array($send_to))
					{
						foreach ($load_permission as $permission)
						{
							if(in_array($permission, $send_to))
							{
								$send_to_this_user = true;
							}
						}
					}
				}
			}

			if($send_to_this_user)
			{
				$user_active = self::is_enable_user($key, $user_id);
				$value['user_active'] = $user_active;
				$new_list[$key] = $value;
			}
		}




		return $new_list;

	}


	public static function get_setting()
	{
		if(self::$setting === false)
		{
			$setting = \lib\app\setting\tools::get_cat('notification');
			if($setting && is_array($setting))
			{
				$setting = array_column($setting, 'value', 'key');
			}
			else
			{
				$setting = [];
			}

			self::$setting = $setting;
		}


		return self::$setting;
	}


	public static function is_enable_user($_event, $_user_id)
	{
		$get = \lib\app\setting\tools::get_cat_key_user('notification_user', $_event, $_user_id);

		if(strval(a($get, 'value')) === '0')
		{
			return false;
		}

		return true;

	}


	public static function is_enable($_event)
	{
		$get_setting = self::get_setting();
		if(strval(a($get_setting, $_event)) === '0')
		{
			return false;
		}

		return true;
	}



	public static function set_setting($_args)
	{

		$list = self::get_sample();

		$update = [];

		foreach ($list as $key => $value)
		{
			if(a($_args, 'set_'. $key))
			{
				$active = a($_args, $key) ? 1 : 0;
				\lib\app\setting\tools::update('notification', $key, $active);
			}
		}

		return true;

	}




	public static function set_user_setting($_args, $_user_code)
	{
		$list = self::get_sample_user($_user_code);

		if(!$list)
		{
			\dash\notif::error(T_("No notification found to send to this user"));
			return false;
		}

		$update = [];

		$user_id = \dash\coding::decode($_user_code);

		foreach ($list as $key => $value)
		{
			if(a($_args, 'set_'. $key))
			{
				$active = a($_args, $key) ? 1 : 0;
				\lib\app\setting\tools::update_user('notification_user', $key, $active, $user_id);
			}
		}

		return true;

	}
}
?>