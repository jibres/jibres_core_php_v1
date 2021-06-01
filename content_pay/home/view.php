<?php
namespace content_pay\home;


class view
{
	public static function config()
	{
		\dash\data::userToggleSidebar(false);

		if(\dash\data::transactionMode())
		{
			self::config_transaction_mode();
		}
		else
		{
			self::config_donate_mode();
		}
	}


	private static function config_donate_mode()
	{
		\dash\face::title(T_('Pay'));

		if(\dash\request::get('amount'))
		{
			$amount = \dash\request::get('amount');

			if($amount = \dash\validate::price($amount, false))
			{
				\dash\data::myAmount($amount);
			}
		}


		if(\dash\request::get('mobile'))
		{
			$mobile = \dash\request::get('mobile');

			if($mobile = \dash\validate::mobile($mobile, false))
			{
				\dash\data::myMobile($mobile);
			}
		}

		if(\dash\request::get('autosend'))
		{
			\dash\data::global_scriptPage('pay_formsubmit.js');
		}

	}


	private static function config_transaction_mode()
	{
		\dash\face::desc(T_('Pay'));


		\dash\utility\pay\get::set_payment_setting();



		$result = \dash\data::dataRow();
		if(isset($result['payment_response']))
		{
			if(is_string($result['payment_response']))
			{
				$payment_response = json_decode($result['payment_response'], true);
				\dash\data::payDetail($payment_response);
			}
		}

		if(\dash\permission::supervisor())
		{
			foreach ($result as $key => $value)
			{
				if(in_array($key, ['payment_response', 'payment_response1', 'payment_response2', 'payment_response3', 'payment_response4']))
				{
					$result[$key] = json_decode($value, true);
				}
			}
			\dash\data::dataRow($result);

		}
	}
}
?>