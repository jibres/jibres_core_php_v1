<?php
namespace content_a\setting\order;


class model
{
	public static function post()
	{
		$post                       = [];

		if(\dash\request::post('create') === 'satisfaction_survey')
		{
			$result = \lib\app\form\form\add::satisfaction_survey();
			if(isset($result['id']))
			{
				\dash\redirect::to(\dash\url::here(). '/form/edit?id='. $result['id']);
			}

			return;
		}

		if(\dash\request::post('create') === 'shipping_survey')
		{
			$result = \lib\app\form\form\add::shipping_survey();
			if(isset($result['id']))
			{
				\dash\redirect::to(\dash\url::here(). '/form/edit?id='. $result['id']);
			}

			return;
		}

		if(\dash\request::post('set_payment_online'))
		{
			$post['payment_online']     = \dash\request::post('payment_online');
		}


		if(\dash\request::post('set_default_payment'))
		{
			$post['default_payment']     = \dash\request::post('default_payment');
		}

		if(\dash\request::post('set_payment_on_deliver'))
		{
			$post['payment_on_deliver'] = \dash\request::post('payment_on_deliver');
		}

		if(\dash\request::post('set_payment_card'))
		{
			$post['payment_card'] = \dash\request::post('payment_card');
		}


		\lib\app\setting\set::save_payment($post);

		\dash\notif::ok(T_("Saved"));
		\dash\redirect::pwd();
	}
}
?>
