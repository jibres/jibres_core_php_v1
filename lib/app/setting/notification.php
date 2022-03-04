<?php
namespace lib\app\setting;


class notification
{
	private static $setting = false;
	private static $template = false;

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
			'fn'     => '\\lib\\app\\log\\caller\\order\\order_adminNewOrderBeforePay',
		  ],

		  'after_pay' =>
		  [
			'title'  => T_("After pay"),
			'fn'     => '\\lib\\app\\log\\caller\\order\\order_adminNewOrderAfterPay',
		  ],

		  'new_order' =>
		  [
			'title'  => T_("New order"),
			'fn'     => '\\lib\\app\\log\\caller\\order\\order_customerNewOrder',
		  ],

		  'sending_order' =>
		  [
			'title'  => T_("Sending order"),
			'fn'     => '\\lib\\app\\log\\caller\\order\\order_customerSendingOrder',
		  ],

		  'tracking_number' =>
		  [
			'title'  => T_("Tracking number"),
			'fn'     => '\\lib\\app\\log\\caller\\order\\order_customerTrackingNumber',
		  ],

		];

		$template = self::get_template();


		foreach ($sample as $key => $value)
		{
			$args['data']['template'] = a($template, $key);
			$sample[$key]['text'] = call_user_func([$value['fn'], 'get_msg'], $args);
			$sample[$key]['active'] = self::is_enable($key);

			if(is_callable([$value['fn'], 'template_list']))
			{
				$template = call_user_func([$value['fn'], 'template_list'], $args);

				$sample[$key]['template'] = $template;
			}


		}

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


	public static function get_template($_event = null)
	{
		if(self::$template === false)
		{
			$template = \lib\app\setting\tools::get_cat('notification_template');
			if($template && is_array($template))
			{
				$template = array_column($template, 'value', 'key');
			}
			else
			{
				$template = [];
			}

			self::$template = $template;
		}


		if($_event)
		{
			return a(self::$template, $_event);
		}


		return self::$template;
	}



	public static function set_template($_event, $_template)
	{

		$list = self::get_sample();

		$update = [];

		foreach ($list as $key => $value)
		{
			if($_event === $key)
			{
				if(isset($value['template'][$_template]))
				{
					\lib\app\setting\tools::update('notification_template', $key, intval($_template));
				}
				else
				{
					\dash\notif::error(T_("Invalid template id"));
					return false;
				}
			}
		}

		return true;
	}
}
?>