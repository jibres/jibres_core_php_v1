<?php
namespace content_a\setting\sms;


class model
{
	public static function post()
	{
		$amount = abs(intval(\dash\request::post('amount')));

		$meta =
		[
			'msg_go'        => null,
			'turn_back'     => \dash\url::pwd(),
			'user_id'       => \lib\userstore::id(),
			'final_fn'      => ['/content_a/setting/sms/model', 'bank_back_transaction'],
			'final_fn_args' => ['amount' => $amount],
			'amount'        => $amount,
			'auto_go'       => false,
			'other_field'   =>
			[

			],
		];

		\dash\utility\pay\start::site($meta);
	}


	public static function bank_back_transaction($_args)
	{
		extract($_args);

		$store_detail = \lib\db\stores::get(['id' => \lib\store::id(), 'limit' => 1]);

		$smsbalance = 0;

		if(isset($store_detail['smsbalance']))
		{
			$smsbalance = intval($store_detail['smsbalance']);
		}

		$new_balance = intval($amount) + $smsbalance;

		\dash\log::set('chargeSmsBalance', ['amount' => $amount]);

		\lib\db\stores::update(['smsbalance' => $new_balance], \lib\store::id());

		\lib\store::refresh();
	}
}
?>