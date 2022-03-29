<?php
namespace content_pay\home;


class view
{
	public static function config()
	{
		\dash\data::include_m2('wide');

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
		\dash\face::title(T_('Quick Pay'));
		\dash\face::desc(T_('Through this page, you can make your payment quickly'));

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
		\dash\face::title(T_('Pay'));


		$transactionDetail = \dash\data::dataRow();

		\dash\face::desc(T_('Pay'). ' '. \dash\fit::number(a($transactionDetail, 'plus')). ' '. a($transactionDetail, 'currency_name'));


		$payment_setting = \dash\utility\pay\get::set_payment_setting();
		\dash\data::myPayment(a($payment_setting, 'list'));
		\dash\data::myPaymentDefault(a($payment_setting, 'default'));

		if(a($payment_setting, 'count_active') === 1 && \dash\data::myPaymentDefault() && a($transactionDetail, 'condition') === 'request')
		{
			// \dash\data::global_scriptPage('pay_formsubmit.js');
			$args          = [];
			$args['token'] = \dash\url::module();
			$args['bank']  = \dash\data::myPaymentDefault();

			\dash\utility\pay\start::bank($args);

			return; // redirect to bank
		}




		if(isset($transactionDetail['payment_response']))
		{
			if(is_string($transactionDetail['payment_response']))
			{
				$payment_response = json_decode($transactionDetail['payment_response'], true);
				\dash\data::payDetail($payment_response);
			}
		}



		if(\dash\permission::supervisor())
		{
			foreach ($transactionDetail as $key => $value)
			{
				if(in_array($key, ['payment_response', 'payment_response1', 'payment_response2', 'payment_response3', 'payment_response4']) && $value)
				{
					$transactionDetail[$key] = json_decode($value, true);
				}
			}
			\dash\data::dataRow($transactionDetail);

		}
	}
}
?>