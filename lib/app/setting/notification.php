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
		  	'title' => T_("Before pay"),
		  	'text' => \lib\app\log\caller\order\order_adminNewOrderBeforePay::get_msg($args),
		  	'active' => self::is_enable('before_pay'),
		  ],

		  'after_pay' =>
		  [
		  	'title' => T_("After pay"),
		  	'text' => \lib\app\log\caller\order\order_adminNewOrderAfterPay::get_msg($args),
		  	'active' => self::is_enable('after_pay'),
		  ],

		  'new_order' =>
		  [
		  	'title' => T_("New order"),
		  	'text' => \lib\app\log\caller\order\order_customerNewOrder::get_msg($args),
		  	'active' => self::is_enable('new_order'),
		  ],

		  'sending_order' =>
		  [
		  	'title' => T_("Sending order"),
		  	'text' => \lib\app\log\caller\order\order_customerSendingOrder::get_msg($args),
		  	'active' => self::is_enable('sending_order'),
		  ],

		  'tracking_number' =>
		  [
		  	'title' => T_("Tracking number"),
		  	'text' => \lib\app\log\caller\order\order_customerTrackingNumber::get_msg($args),
		  	'active' => self::is_enable('tracking_number'),
		  ],

		];

		return $sample;
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
}
?>