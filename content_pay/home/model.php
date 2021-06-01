<?php
namespace content_pay\home;


class model
{
	public static function post()
	{
		if(\dash\data::transactionMode())
		{
			if(\dash\request::post('ok') == '1')
			{
				$args          = [];
				$args['token'] = \dash\url::module();
				$args['bank']  = \dash\request::post('bank');

				\dash\utility\pay\start::bank($args);
			}
		}
		else
		{
			if(\dash\request::post('donate') === 'donate')
			{
				$post            = [];
				$post['mobile']  = \dash\request::post('mobile');
				$post['amount']  = \dash\request::post('amount');
				$post['payment'] = \dash\request::get('payment');
				$post['tp']      = \dash\request::get('tp');

				\dash\app\transaction\add::donate($post);
			}
		}


	}
}
?>